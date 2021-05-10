<?php
/**
 * @copyright ©2018 浙江禾匠信息科技
 * @author Lu Wei
 * @link http://www.zjhejiang.com/
 * Created by IntelliJ IDEA
 * Date Time: 2018/11/16 11:15
 */


namespace app\forms\mall\index;


use app\core\response\ApiCode;
use app\models\MallSetting;
use app\models\Model;
use yii\helpers\Html;

class SettingForm extends Model
{
    public $name;
    public $contact_tel;
    public $over_time;
    public $delivery_time;
    public $after_sale_time;
    public $payment_type;
    public $send_type;
    public $kdniao_mch_id;
    public $kdniao_api_key;
    public $member_integral;
    public $member_integral_rule;
    public $good_negotiable;
    public $mobile_verify;
    public $is_small_app;
    public $small_app_id;
    public $small_app_url;
    public $small_app_pic;
    public $is_customer_services;
    public $customer_services_pic;
    public $is_dial;
    public $dial_pic;
    public $is_web_service;
    public $web_service_url;
    public $web_service_pic;
    public $is_quick_navigation;
    public $quick_navigation_style;
    public $quick_navigation_opened_pic;
    public $quick_navigation_closed_pic;
    public $is_show_stock;
    public $is_use_stock;
    public $sell_out_pic;
    public $sell_out_other_pic;

    public $is_common_user_member_price;
    public $is_member_user_member_price;
    public $is_share_price;
    public $is_purchase_frame;
    public $purchase_num;
    public $is_comment;
    public $is_sales;
    public $is_mobile_auth;
    public $is_official_account;
    public $is_manual_mobile_auth;
    public $is_icon_members_grade;
    public $is_goods_video;

    public $is_quick_map;
    public $quick_map_pic;
    public $quick_map_address;
    public $longitude;
    public $latitude;
    public $is_quick_home;
    public $quick_home_pic;

    public $logo;

    public $share_title;
    public $share_pic;

    public $is_add_app;
    public $add_app_bg_color;
    public $add_app_bg_transparency;
    public $add_app_bg_radius;
    public $add_app_text;
    public $add_app_text_color;
    public $add_app_icon_color_type;

    public $is_close;
    public $business_time_type;
    public $business_time_custom_type;
    public $business_time_type_day;
    public $business_time_type_week;
    public $auto_business;
    public $auto_business_time;
    public $is_icon_super_vip;
    public $is_show_normal_vip;
    public $is_show_super_vip;
    public $is_required_position;
    public $is_share_tip;
    public $is_must_login;

    //购物车
    public $is_show_cart;
    //已售量（商品列表）
    public $is_show_sales_num;
    //商品名称
    public $is_show_goods_name;
    //划线价
    public $is_underline_price;
    //列表划线价
    public $is_list_underline_price;
    //快递
    public $is_express;
    //非分销商分销中心显示
    public $is_not_share_show;
    //购物车悬浮按钮
    public $is_show_cart_fly;
    //回到顶部悬浮按钮
    public $is_show_score_top;

    public $express_select_type;
    public $express_aliapy_code;

    public $is_quick_customize;
    public $quick_customize_pic;
    public $quick_customize_open_type;
    public $quick_customize_params;
    public $quick_customize_new_params;
    public $quick_customize_link_url;
    public $mall_logo_pic;
    public $send_type_desc;

    public $is_show_hot_goods;

    public $kd100_key;
    public $kd100_customer;
    public $kd100_secret;
    public $kd100_siid;
    public $print_type;

    public $is_open;
    public $open_type;
    public $week_list;
    public $time_list;
    public $is_auto_open;
    public $auto_open_time;
    public $show_contact_type;

    public $is_video_number;
    public $video_number_app_id;
    public $video_number_app_secret;
    public $is_video_number_member;
    public $video_number_member_list;
    public $video_number_template_list;
    public $video_number_share_title;
    public $video_number_user_1;
    public $video_number_user_2;

    public $kdniao_select_type;

    public function rules()
    {
        return [
            [['name'], 'trim',],
            [['contact_tel', 'kdniao_mch_id', 'kdniao_api_key', 'member_integral_rule',
                'small_app_id', 'small_app_url', 'small_app_pic', 'customer_services_pic',
                'dial_pic', 'web_service_url', 'web_service_pic', 'quick_navigation_closed_pic',
                'quick_navigation_opened_pic', 'quick_map_pic', 'quick_map_address', 'longitude', 'latitude',
                'quick_home_pic', 'logo', 'share_title', 'share_pic', 'add_app_bg_color', 'add_app_text',
                'add_app_text_color', 'sell_out_pic', 'sell_out_other_pic', 'express_select_type', 'express_aliapy_code',
                'quick_customize_pic', 'quick_customize_open_type', 'quick_customize_link_url', 'mall_logo_pic',
                'kd100_key', 'kd100_customer', 'kd100_secret', 'kd100_siid', 'print_type', 'auto_open_time', 'auto_open_time', 'video_number_app_id', 'video_number_app_secret', 'video_number_share_title', 'kdniao_select_type', 'video_number_user_1', 'video_number_user_2'], 'string'],
            [['over_time', 'delivery_time', 'after_sale_time', 'member_integral',
                'mobile_verify', 'is_customer_services', 'is_dial', 'quick_navigation_style',
                'is_common_user_member_price', 'is_member_user_member_price', 'is_share_price', 'is_purchase_frame',
                'is_comment', 'is_sales', 'is_mobile_auth', 'is_official_account', 'is_icon_members_grade',
                'is_quick_map', 'is_small_app', 'is_web_service', 'is_quick_navigation',
                'is_manual_mobile_auth', 'is_quick_home', 'is_add_app', 'add_app_bg_transparency', 'add_app_bg_radius',
                'add_app_icon_color_type', 'purchase_num', 'is_close', 'business_time_type',
                'business_time_custom_type', 'auto_business', 'is_icon_super_vip', 'is_show_normal_vip',
                'is_show_super_vip', 'is_show_cart', 'is_show_sales_num', 'is_show_goods_name', 'is_underline_price',
                'is_list_underline_price', 'is_express', 'is_not_share_show', 'is_show_cart_fly', 'is_show_score_top',
                'is_goods_video', 'is_show_stock', 'is_use_stock', 'is_required_position', 'is_share_tip', 'is_quick_customize', 'is_must_login',
                'is_show_hot_goods', 'is_open','open_type','is_auto_open', 'show_contact_type', 'is_video_number', 'is_video_number_member'], 'integer'],
            [['name'], 'required',],
            [['share_title', 'share_pic', 'sell_out_pic', 'sell_out_other_pic', 'express_select_type', 'express_aliapy_code', 'mall_logo_pic'], 'default', 'value' => ''],
            [['good_negotiable', 'payment_type', 'send_type', 'business_time_type_day', 'business_time_type_week',
                'auto_business_time', 'quick_customize_params', 'quick_customize_new_params', 'send_type_desc', 'time_list', 'week_list', 'video_number_member_list', 'video_number_template_list'], 'safe'],
            [['delivery_time', 'after_sale_time'], 'integer', 'min' => 0, 'max' => 30],
            [['over_time'], 'integer', 'min' => 0, 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'member_integral' => '积分',
            'delivery_time' => '自动确认收货时间',
            'over_time' => '未支付订单超时时间',
            'after_sale_time' => '售后时间',
        ];
    }

    public function save()
    {
        $this->name = Html::encode($this->name);
        if (!$this->validate()) {
            return $this->getErrorResponse($this);
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if ($this->is_open == 1 && $this->open_type == 2 && empty($this->week_list)) {
                throw new \Exception('请选择营业日期星期');
            }

            $this->checkData();

            $isAddApp = false;
            foreach ($this->attributes as $k => $item) {
                if ($k == 'is_add_app') {
                    $isAddApp = $item;
                }
                if ($isAddApp && $k == 'add_app_text' && mb_strlen($item) > 20) {
                    throw new \Exception('小程序提示->提示文本内容长度不能大于20个字符');
                }

                $arr = ['name', 'latitude_longitude'];
                if (in_array($k, $arr)) {
                    continue;
                }

                if ($k == 'good_negotiable' && empty($item)) {
                    $item = ['contact'];
                }

                if (in_array($k, ['good_negotiable', 'payment_type', 'send_type', 'business_time_type_week', 'business_time_type_day', 'quick_customize_new_params', 'send_type_desc', 'week_list', 'time_list', 'video_number_member_list', 'video_number_template_list'])) {
                    $newItem = json_encode($item, true);
                } else {
                    $newItem = $item;
                }

                $k === 'quick_customize_params' && $newItem = '';
                if ($k == 'web_service_url') {
                    $newItem = urlencode($item);
                }

                $mallSetting = MallSetting::findOne(['key' => $k, 'mall_id' => \Yii::$app->mall->id]);
                if ($mallSetting) {
                    $mallSetting->value = (string)$newItem;
                    $res = $mallSetting->save();
                } else {
                    $mallSetting = new MallSetting();
                    $mallSetting->key = $k;
                    $mallSetting->value = (string)$newItem;
                    $mallSetting->mall_id = \Yii::$app->mall->id;
                    $res = $mallSetting->save();
                }

                if (!$res) {
                    throw new \Exception($this->getErrorMsg($mallSetting));
                }
            }

            \Yii::$app->mall->attributes = $this->attributes;
            if (!\Yii::$app->mall->save()) {
                throw new \Exception('保存失败,商城数据异常');
            }

            $transaction->commit();
            return [
                'code' => ApiCode::CODE_SUCCESS,
                'msg' => '保存成功。',
            ];
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
                'code' => ApiCode::CODE_ERROR,
                'msg' => $e->getMessage(),
                'error' => [
                    'line' => $e->getLine(),
                ]
            ];
        }
    }

    private function checkData()
    {
        if ($this->is_video_number) {
            if (!$this->video_number_app_id || !$this->video_number_app_secret) {
                throw new \Exception("请填写视频号 AppId和AppSecret");
            }

            if (!$this->video_number_share_title) {
                throw new \Exception('请填写视频号分享标题');
            }

            if (mb_strlen($this->video_number_share_title) > 20) {
                throw new \Exception("视频号分享标题不能大于20个字");
            }

            if (!count($this->video_number_template_list)) {
                throw new \Exception("请选择视频号模板");
            }

            if ($this->is_video_number_member && !count($this->video_number_member_list)) {
                throw new \Exception('请选择视频号会员等级');
            }

            if (!$this->video_number_user_1 || !$this->video_number_user_2) {
                throw new \Exception('请填写视频号公众号用户openId');
            }
        }
    }
}
