<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/16 16:11
 */

namespace app\controllers\system;

use app\controllers\Controller;
use app\models\CityService;
use app\models\Mall;
use app\models\Model;
use app\models\OrderDetailExpress;
use app\models\VideoNumber;
use luweiss\Wechat\WechatHelper;
use yii\web\Response;

class MsgNotifyController extends Controller
{
    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;
    }

    public function actionCityService()
    {
        \Yii::error('微信事件推送接口回调');

        // 微信第一次配置时需校验
        if (isset($_GET["echostr"]) && $_GET["echostr"]) {
            return $_GET['echostr'];
        }

        // 验签
        if (!$this->checkSignature()) {
            return 'error 验签失败';
        }

        \Yii::$app->response->format = Response::FORMAT_XML;
        $xml = \Yii::$app->request->rawBody;
        $xmlDataArray = WechatHelper::xmlToArray($xml);
        \Yii::error($xmlDataArray);

        switch ($xmlDataArray['Event']) {
            // 群发回调事件
            case 'MASSSENDJOBFINISH':
                $this->updateSph($xmlDataArray);
                break;
        }

        // yii 框架方式处理方式 | php获取json数据方式 file_get_contents('php://input')
        $json = \Yii::$app->request->rawBody;
        $jsonDataArray = json_decode($json, true);
        \Yii::error($jsonDataArray);

        switch ($jsonDataArray['Event']) {
            // 同城配送推送事件
            case 'update_waybill_status':
                $this->updateExpress($jsonDataArray);
                break;
        }

        return "success";
    }

    private function checkSignature()
    {
        $signature = isset($_GET["signature"]) ? $_GET["signature"] : '';
        $timestamp = isset($_GET["timestamp"]) ? $_GET["timestamp"] : '';
        $nonce = isset($_GET["nonce"]) ? $_GET["nonce"] : '';
        
        $token = 'token';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        
        if( $tmpStr == $signature ){
            \Yii::error('验签通过');
            return true;
        }else{
            \Yii::error('验签不通过');
            return false;
        }
    }

    // 更新视频号数据
    private function updateSph($data)
    {
        try {
            $videoNumber = VideoNumber::find()->andWhere(['msg_id' => $data['MsgID']])->one();

            if ($videoNumber) {
                $extraAttributes = json_decode($videoNumber->extra_attributes, true);
                $extraAttributes['event_result'] = $data;
                $videoNumber->extra_attributes = json_encode($extraAttributes);
                $videoNumber->status = $data['Status'];
                $videoNumber->save();
            }
        }catch(\Exception $exception) {
            \Yii::error('群发消息回调出错');
            \Yii::error($exception);
        }
    }

    // 更新快递小哥信息
    private function updateExpress($data)
    {
        try {
            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['shop_order_id']])->one();
            if ($express) {
                // 骑手接单
                if ($data['order_status'] == 102) {
                    $express->city_name = $data['agent']['name'];
                    $express->city_mobile = $data['agent']['phone'];
                }
                $cityInfo = json_decode($express->city_info, true);
                $cityInfo[$data['order_status']] = $data;
                $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
                $express->status = $data['order_status'];
                $res = $express->save();
                if (!$res) {
                    throw new \Exception((new Model)->getErrorMsg($express));
                }
            }
        } catch (\Exception $exception) {
            \Yii::error('同城配送回调出错');
            \Yii::error($exception);
        }
    }

    public function actionSf()
    {
        \Yii::error('顺丰接口回调');
        // php获取json数据方式 file_get_contents('php://input')
        // yii 框架方式
        $data = \Yii::$app->request->post();
        \Yii::error($data);
        $this->updateSfExpress($data);
        $responseData = [
            'error_code' => 0,
            'error_msg' => 'success',
        ];
        \Yii::$app->response->data = $responseData;
    }

    // 更新快递小哥信息
    private function updateSfExpress($data)
    {
        try {
            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['shop_order_id']])->one();
            if (!$express) {
                throw new \Exception('顺风同城未找到记录');
            }
            $mall = Mall::findOne($express->mall_id);
            if (!$mall) {
                throw new \Exception('未查询到id=' . $express->mall_id . '的商城。 ');
            }
            \Yii::$app->setMall($mall);

            $server = CityService::findOne($express->city_service_id);
            if (!$server) {
                throw new \Exception('配送配置不存在');
            }

            // 骑手接单
            if ($data['order_status'] == 10) {
                $express->city_name = $data['operator_name'];
                $express->city_mobile = $data['operator_phone'];
            }
            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$this->transCodeBySf($data['order_status'])] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $this->transCodeBySf($data['order_status']);
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

        } catch (\Exception $exception) {
            \Yii::error('同城配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    private function transCodeBySf($code)
    {
        switch ($code) {
            case '10':
                return 102;
            case '12':
                return 202;
            case '15':
                return 301;
            case '17':
                return 302;
            default:
                return $code;
        }
    }

    public function actionSs()
    {
        \Yii::error('闪送接口回调');
        $data = file_get_contents('php://input');
        \Yii::error($data);
        $data = json_decode($data, true);
        \Yii::error($data);
        $this->updateSsExpress($data);
    }

    // 更新快递小哥信息
    private function updateSsExpress($data)
    {
        try {
            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['orderNo']])->one();
            if (!$express) {
                throw new \Exception('闪送同城未找到记录');
            }
            $mall = Mall::findOne($express->mall_id);
            if (!$mall) {
                throw new \Exception('未查询到id=' . $express->mall_id . '的商城。 ');
            }
            \Yii::$app->setMall($mall);

            $server = CityService::findOne($express->city_service_id);
            if (!$server) {
                throw new \Exception('闪送配送配置不存在');
            }

            // 骑手接单
            if ($data['status'] == 30) {
                $express->city_name = $data['courier']['name'];
                $express->city_mobile = $data['courier']['mobile'];
            }
            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$this->transCodeBySs($data['status'])] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $this->transCodeBySs($data['status']);
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }
        } catch (\Exception $exception) {
            \Yii::error('闪送同城配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    private function transCodeBySs($code)
    {
        switch ($code) {
            case '30':
                return 102;
            case '40':
                return 202;
            case '50':
                return 302;
            default:
                return $code;
        }
    }

    // 达达接口回调
    public function actionDadaCityService()
    {
        \Yii::error('达达接口回调');
        $json = \Yii::$app->request->rawBody;
        $data = json_decode($json, true);
        \Yii::error($data);

        $this->updateDadaExpress($data);
        return "success";
    }

    private function updateDadaExpress($data)
    {
        try {
            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['order_id']])->one();
            if (!$express) {
                throw new \Exception('达达订单物流不存在');
            }
            $mall = Mall::findOne($express->mall_id);
            if (!$mall) {
                throw new \Exception('未查询到id=' . $express->mall_id . '的商城。 ');
            }
            \Yii::$app->setMall($mall);

            $server = CityService::findOne($express->city_service_id);
            if (!$server) {
                throw new \Exception('配送配置不存在');
            }

            // 骑手接单
            if ($data['order_status'] == 2) {
                $express->city_name = $data['dm_name'];
                $express->city_mobile = $data['dm_mobile'];
            }
            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$this->transCodeByDada($data['order_status'])] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $this->transCodeByDada($data['order_status']);
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

        } catch (\Exception $exception) {
            \Yii::error('达达配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    private function transCodeByDada($code)
    {
        switch ($code) {
            case '2':
                return 102;
            case '3':
                return 202;
            case '4':
                return 302;
            default:
                return $code;
        }
    }

    // 美团接口回调
    public function actionMtCityService()
    {
        \Yii::error('美团接口回调');
        $json = \Yii::$app->request->rawBody;
        $data = json_decode($json, true);
        \Yii::error($data);

        // $this->updateMtExpress($data);
        return "success";
    }

    private function updateMtExpress($data)
    {
        try {
            $express = OrderDetailExpress::find()->andWhere(['shop_order_id' => $data['order_id']])->one();
            if (!$express) {
                throw new \Exception('美团订单物流不存在');
            }
            $mall = Mall::findOne($express->mall_id);
            if (!$mall) {
                throw new \Exception('未查询到id=' . $express->mall_id . '的商城。 ');
            }
            \Yii::$app->setMall($mall);

            $server = CityService::findOne($express->city_service_id);
            if (!$server) {
                throw new \Exception('配送配置不存在');
            }

            // 骑手接单
            if ($data['order_status'] == 2) {
                $express->city_name = $data['dm_name'];
                $express->city_mobile = $data['dm_mobile'];
            }
            $cityInfo = json_decode($express->city_info, true);
            $cityInfo[$this->transCodeByMt($data['order_status'])] = $data;
            $express->city_info = json_encode($cityInfo, JSON_UNESCAPED_UNICODE);
            $express->status = $this->transCodeByMt($data['order_status']);
            $res = $express->save();
            if (!$res) {
                throw new \Exception((new Model)->getErrorMsg($express));
            }

        } catch (\Exception $exception) {
            \Yii::error('美团配送回调出错');
            \Yii::error($exception);
            exit;
        }
    }

    private function transCodeByMt($code)
    {
        switch ($code) {
            case '20':
                return 102;
            case '30':
                return 202;
            case '50':
                return 302;
            default:
                return $code;
        }
    }
}
