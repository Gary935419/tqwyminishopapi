<?php defined('YII_ENV') or exit('Access Denied');
    Yii::$app->loadViewComponent('app-poster');
    Yii::$app->loadViewComponent('poster/app-poster-new');
    Yii::$app->loadViewComponent('app-rich-text');
    $_currentPluginBaseUrl = \app\helpers\PluginHelper::getPluginBaseAssetsUrl(Yii::$app->plugin->currentPlugin->getName());
?>
<style>
    .info-title {
        margin-left: 20px;
        color: #ff4544;
    }
    .info-title span {
        color: #3399ff;
        cursor: pointer;
        font-size: 13px;
    }
    .el-tabs__header {
        padding: 0 20px;
        height: 56px;
        line-height: 56px;
        background-color: #fff;
        margin-bottom: 10px;
    }
    .form-body {
        padding: 10px 20px;
        background-color: #fff;
        margin-bottom: 20px;
    }

    .button-item {
        padding: 9px 25px;
    }

    .red {
        color: #ff4544;
        margin-left: 10px;
    }

    .input-len input {
           width: 400px;
           height: 33px;
    }

    .input-len-i {
        width: 300px;
        height: 33px;
    }
    .input-len {
        width: 400px;
        height: 33px;
    }
    .input-len-i input {
        width: 255px;
        height: 33px;
    }

    .el-input__count-inner {
        background-color: transparent !important;
    }
    .iphone {
        min-width: 400px;
        height: 740px;
        background-color: white;
        border-radius: 23px;
        background-repeat: no-repeat;
        background-position: 50% 50%;
        position: relative;
    }
    .background-iphone {
        background-repeat: no-repeat;
        width: 300px;
        height: 400px;
        position: absolute;
        top: 178px;
        left: 50%;
        transform: translate(-50%, 0);
        background-size: 100% 100%;
    }
    .content-phone {
        width: 1250px;
        background-color: white;
        border-radius: 5px;
        margin-left: 20px;
        padding: 20px 35% 20px 20px;
    }
    .color-item {
        width: 126px;
        height: 60px;
        border: 1px solid #f0f0f0;
        margin-right: 23px;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
    }
    .color-item-active {
        border-color: #3399ff;
    }
    .color-item .img {
        width: 46px;
        height: 32px;
        margin-right: 10px;
    }
    .theme-color-template {
        width: 850px;
        height: 480px;
        margin-top: 40px;
    }
    .template-image {
        width: 252px;
        height: 474px;
        background-color: pink;
        box-shadow: 2px 2px 5px #f4f4f4;
        margin-right: 40px;
        border-radius: 5px;
    }
    .background-text {
        position: absolute;
        text-align: center;
    }
    .background-text  p {
        margin: 0;
    }
    .poster_pic {
        width: 80px;
        height: 80px;
        background-repeat: no-repeat;
        background-size:  cover;
    }
    #app {
        min-width: 1000px;
    }

    .avatar {
        width: 62px;
        height: 62px;
        position: absolute;
        top: 62px;
        left: 50%;
        transform: translateX(-50%);
    }

    .tip {
        color: #909399;
        font-size: 13px;
        height: 25px;
    }

    .form-body {
        padding: 20px 0;
        background-color: #fff;
        margin-bottom: 20px;
        padding-right: 40%;
        min-width: 900px;
    }

    .mobile {
        width: 400px;
        height: 740px;
        border: 1px solid #cccccc;
        padding: 25px 10px;
        border-radius: 30px;
        margin: 0 20px;
        position: relative;
        flex-shrink: 0;
        background-color: #ffffff;
    }

    .mobile img {
        width: 375px;
        height: 667px;
    }

    .mobile .bg-img {
        height: 180px;
        width: 375px;
        position: absolute;
        left: 0;
        top: 65px;
    }

    .mobile>div {
        height: 690px;
        position: absolute;
        overflow-x: hidden;
        overflow-y: auto;
        background-size: 100% 100%;
    }

    .reset {
        position: absolute;
        top: 3px;
        left: 90px;
    }

    .del-btn.el-button--mini.is-circle {
        position: absolute;
        top: -6px;
        right: -6px;
        padding: 4px;
    }

    .poster-pic-box {
        cursor: pointer;
        display: inline-block;
        border: 1px solid #E2E2E2;
        border-radius: 3px;

        height: 147px;
        width: 112px;
        margin: 5px;
        padding: 0 5px;
    }

    .poster-pic-box.active {
        border: 1px solid #409eff;
    }

    .poster-pic-box .grid {
        flex-wrap: wrap;
        height: 100px;
        width: 100%;
        background: #E6F4FF;
        border: 1px solid #b8b8b8;
    }

    .required-icon .el-form-item__label:before {
        content: '*';
        color: #F56C6C;
        margin-right: 4px;
    }
</style>

<section id="app" v-cloak>
    <el-card style="border:0" shadow="never" body-style="background-color: #f3f3f3;padding: 0 0;" v-loading="loading">
        <div class="text item" style="width:100%">
            <el-form :model="form" :rules="rules" label-width="150px" size="small" ref="form">
                <el-tabs v-model="activeName">

                    <el-tab-pane label="????????????" class="form-body" name="first">
                        <el-form-item class="switch" label="??????????????????" prop="is_share">
                            <el-switch v-model="form.is_share" :active-value="1" :inactive-value="0"></el-switch>
                            <span class="red">??????????????????
                                <el-button type="text" @click="$navigate({r:'mall/share/basic'}, true)">????????????=>????????????</el-button>
                                ???????????????????????????
                            </span>
                        </el-form-item>
                        <el-form-item label="????????????????????????" prop="is_apply">
                            <el-switch v-model="form.is_apply" active-value="1" inactive-value="0"></el-switch>
                        </el-form-item>
                        <el-form-item label="????????????????????????" prop="is_allow_change">
                            <el-switch v-model="form.is_allow_change" active-value="1" inactive-value="0"></el-switch>
                        </el-form-item>
                        <el-form-item label="????????????" prop="is_apply_money">
                            <el-radio-group v-model="form.is_apply_money">
                                <el-radio label="1">??????</el-radio>
                                <el-radio label="0">??????</el-radio>
                            </el-radio-group>
                            <div v-if="form.is_apply_money == 1" flex="dir:left cross:center" style="margin-top: 10px;">
                            	<div>??????</div>
                            	<div style="margin-left: 10px;">
	                                <el-input type="number" style="width: 200px;" v-model.number="form.apply_money">
	                                    <template slot="append">???</template>
	                                </el-input>
                            	</div>
                            	<div style="margin-left: -2px;margin-right: 10px;">
	                                <el-input maxlength="10" style="width: 100px;" v-model.number="form.apply_money_name"></el-input>
	                            </div>
                                <div>?????????????????????</div>
                            </div>
                            <div v-if="form.is_apply_money == 1" class="tip">??????????????????????????????????????????????????????</div>
                        </el-form-item>
                        <el-form-item label="????????????" prop="name">
                            <el-input maxlength="6" show-word-limit type="text" size="small" style="width: 390px;" v-model="form.middleman" autocomplete="off"></el-input>
                            <div class="tip">?????????????????????????????????????????????<el-button style="margin-left: 10px" type="text" @click="dialogVisible = true">??????????????????</el-button></div>
                        </el-form-item>
                        <el-form-item label="????????????" prop="sell_out_sort">
                            <el-radio-group v-model="form.sell_out_sort">
                                <el-radio label="1">??????</el-radio>
                                <el-radio label="2">??????</el-radio>
                                <el-radio label="3">???????????????????????????</el-radio>
                            </el-radio-group>
                        </el-form-item>
                        <el-form-item label="??????????????????" prop="app_share_title">
                            <div>
                                <el-input style="width: 220px"
                                          v-model="form.app_share_title"
                                          placeholder="?????????????????????">
                                </el-input>
                            </div>
                            <el-button @click="app_share.dialog = true;app_share.type = 'name_bg'"
                                       type="text">????????????
                            </el-button>
                        </el-form-item>
                        <el-form-item label="??????????????????" prop="app_share_pic">
                            <app-attachment :multiple="false" :max="1" v-model="form.app_share_pic">
                                <el-tooltip class="item"
                                            effect="dark"
                                            content="????????????:420 * 336"
                                            placement="top">
                                    <el-button size="mini">????????????</el-button>
                                </el-tooltip>
                            </app-attachment>
                            <app-image mode="aspectFill" width='80px' height='80px' :src="form.app_share_pic">
                            </app-image>
                            <el-button @click="app_share.dialog = true;app_share.type = 'pic_bg'"
                                       type="text">????????????
                            </el-button>
                        </el-form-item>
                    </el-tab-pane>
                    <el-tab-pane label="????????????" name="second">
                        <div class="form-body">
                            <el-form-item label-width="220px" class="switch" label="????????????" prop="is_share">
                                <el-checkbox-group v-model="pay_type">
                                    <el-checkbox label="auto">????????????</el-checkbox>
                                    <el-checkbox label="wechat">??????????????????</el-checkbox>
                                    <el-checkbox label="alipay">?????????????????????</el-checkbox>
                                    <el-checkbox label="bank">?????????????????????</el-checkbox>
                                    <el-checkbox label="balance">????????????</el-checkbox>
                                </el-checkbox-group>
                            </el-form-item>
                            <el-form-item label-width="220px" prop="min_money">
                                <template slot='label'>
                                    <span>??????????????????</span>
                                    <el-tooltip effect="dark" content="??????????????????????????????????????????????????????"
                                            placement="top">
                                        <i class="el-icon-info"></i>
                                    </el-tooltip>
                                </template>
                                <el-input min="0" type="number" size="small" style="width: 590px;" v-model="form.min_money" autocomplete="off">
                                    <template slot="append">???</template>
                                </el-input>
                            </el-form-item>
                            <el-form-item class="required-icon" label-width="220px" prop="cash_service_charge">
                                <template slot='label'>
                                    <span>???????????????</span>
                                    <el-tooltip effect="dark" content="??????????????????-??????????????????x?????????=???????????????????????????0????????????????????????"
                                            placement="top">
                                        <i class="el-icon-info"></i>
                                    </el-tooltip>
                                </template>
                                <el-input min="0" type="number" size="small" style="width: 590px;" v-model="form.cash_service_charge" autocomplete="off">
                                    <template slot="append">%</template>
                                </el-input>
                            </el-form-item>
                            <el-form-item label-width="220px" label="??????????????????????????????">
                                <el-input min="0" type="number" size="small" style="width: 590px;" v-model="form.free_cash_min" autocomplete="off">
                                    <template slot="append">???</template>
                                </el-input>
                            </el-form-item>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="?????????????????????" name="third">
                        <div>
                            <div flex="dir:left">
                                <div class="mobile">
                                    <div :style="{'background-image': 'url('+form.image_bg+')'}">
                                        <img v-if="show_style == '1'" src="./../plugins/community/assets/img/style1.png" alt="">
                                        <img v-else-if="show_style == '2'" src="./../plugins/community/assets/img/style2.png" alt="">
                                        <img v-else-if="show_style == '3'" src="./../plugins/community/assets/img/style3.png" alt="">
                                        <img v-else src="./../plugins/community/assets/img/style4.png" alt="">
                                    </div>
                                </div>
                                <div style="width: 100%;position: relative">
                                    <div class="form-body">
                                        <el-form-item prop="bg_url">
                                            <div style="position: relative;margin-left: -100px;">
                                                <app-attachment :multiple="false" :max="1" @selected="imageBg">
                                                    <el-tooltip class="item" effect="dark" content="????????????:750*360" placement="top">
                                                        <el-button size="mini">???????????????</el-button>
                                                    </el-tooltip>
                                                </app-attachment>
                                                <el-button style="margin-left: 20px" size="mini" @click="resetImg(2)" class="reset" type="primary">????????????</el-button>
                                            </div>
                                        </el-form-item>
                                        <el-form-item label-width="150px" class="poster-style" label="????????????" prop="poster_style">
                                            <el-checkbox-group v-model="form.activity_poster_style" style="max-width: 500px">
                                                <div @click="changeStyle(`1`)"
                                                     :class="[`poster-style-box`, `${form.activity_poster_style.indexOf(`1`) === -1 ? ``:`active`}`]">
                                                    <el-checkbox class="event-step" label="1">?????????</el-checkbox>
                                                    <img src="statics/img/plugins/community/1.png" alt=""/>
                                                </div>
                                                <div @click="changeStyle(`2`)"
                                                     :class="[`poster-style-box`, `${form.activity_poster_style.indexOf(`2`) === -1 ? ``:`active`}`]">
                                                    <el-checkbox class="event-step" label="2">?????????</el-checkbox>
                                                    <img src="statics/img/plugins/community/2.png" alt=""/>
                                                </div>
                                                <div @click="changeStyle(`3`)"
                                                     :class="[`poster-style-box`, `${form.activity_poster_style.indexOf(`3`) === -1 ? ``:`active`}`]">
                                                    <el-checkbox class="event-step" label="3">?????????</el-checkbox>
                                                    <img src="statics/img/plugins/community/3.png" alt=""/>
                                                </div>
                                                <div @click="changeStyle(`4`)"
                                                     :class="[`poster-style-box`, `${form.activity_poster_style.indexOf(`4`) === -1 ? ``:`active`}`]">
                                                    <el-checkbox class="event-step" label="4">?????????</el-checkbox>
                                                    <img src="statics/img/plugins/community/4.png" alt=""/>
                                                </div>
                                            </el-checkbox-group>
                                        </el-form-item>
                                    </div>
                                    <el-button class="button-item" type="primary" :loading="btnLoading" @click="onSubmit('form')">??????</el-button>
                                </div>
                            </div>
                        </div>
                    </el-tab-pane>
                    <el-tab-pane label="??????????????????" name="fourth">
                        <div>
                            <div flex="dir:left">
                                <div class="mobile">
                                    <div style="height: 690px;position: absolute;overflow-x: hidden;overflow-y: auto;">
                                        <img src="statics/img/plugins/community/bg.png" alt="">
                                        <img class="bg-img" :src="form.banner" alt="">
                                    </div>
                                </div>
                                <div style="width: 100%;">
                                    <el-card header="?????????????????????" shadow="never">
                                        <div class="form-body">
                                            <el-form-item label="??????banner??????" prop="bg_url">
                                                <div style="position: relative">
                                                    <app-attachment :multiple="false" :max="1" @selected="topPicUrl">
                                                        <el-tooltip class="item" effect="dark" content="????????????:750*360" placement="top">
                                                            <el-button size="mini">????????????</el-button>
                                                        </el-tooltip>
                                                    </app-attachment>
                                                    <div style="margin-top: 10px;position: relative;display: inline-block">
                                                        <app-image width="100px"
                                                                   height="100px"
                                                                   mode="aspectFill"
                                                                   :src="form.banner">
                                                        </app-image>
                                                        <el-button v-if="form.banner != ''" class="del-btn" size="mini" type="danger" icon="el-icon-close" circle @click="delPic"></el-button>
                                                    </div>
                                                    <el-button size="mini" @click="resetImg(1)" class="reset" type="primary">????????????</el-button>
                                                </div>
                                            </el-form-item>
                                        </div>
                                    </el-card>
                                    <el-button style="margin-top: 20px;" class="button-item" type="primary" :loading="btnLoading" @click="onSubmit('form')">??????</el-button>
                                </div>
                            </div>
                        </div>
                    </el-tab-pane>
                </el-tabs>

                <el-button v-if="activeName == 'first' || activeName == 'second'" class="button-item" type="primary" :loading="btnLoading" @click="onSubmit('form')">??????</el-button>
            </el-form>
        </div>
    </el-card>
    <el-dialog :title="app_share.type == 'name_bg' ? '?????????????????????????????????':'?????????????????????????????????'" :visible.sync="app_share.dialog" width="30%">
        <div style="border-top: 1px solid #e2e2e2;padding-top: 30px;" flex="main:center cross:center">
            <img v-if="app_share.type == 'name_bg'" src="statics/img/mall/app-share-name.png" alt="">
            <img v-if="app_share.type == 'pic_bg'" src="statics/img/mall/app-share-pic.png" alt="">
        </div>
        <span slot="footer" class="dialog-footer">
            <el-button size="small" type="primary" @click="app_share.dialog = false">????????????</el-button>
        </span>
    </el-dialog>
    <el-dialog title="??????????????????" :visible.sync="dialogVisible" width="35%">
        <div style="margin-bottom: 20px;margin-top: -20px;">
            <div>?????????????????????</div>
            <div>????????????????????????-???????????????=????????????????????????????????????????????????????????????????????????????????????????????????????????????</div>
        </div>
        <div style="margin-bottom: 20px">
            <div>???????????????????????????</div>
            <div>??????A??????100?????????????????????80????????????????????????100-80=20???</div>
        </div>
        <div style="margin-bottom: 20px">
            <div>?????????????????????????????????</div>
            <div>??????B??????100?????????????????????80?????????????????????100???30????????????????????????????????????</div>
            <div>?????????????????????100-30=70???????????????????????????</div>
            <div>?????????????????????30/100=30%</div>
            <div>??????????????????80-80*30%*=56????????????????????????</div>
            <div>???????????????70-56=14???</div>
        </div>
        <div>
            <div>?????????????????????????????????</div>
            <div style="margin-bottom: 20px">??????C??????100?????????????????????80????????????D??????200?????????????????????180?????????????????????300???60????????????????????????????????????</div>
            <div>??????C?????????????????????[100/???100+200???]*60???20???</div>
            <div>??????C?????????????????????100-20=80???????????????????????????</div>
            <div>?????????????????????20/100=20%</div>
            <div>??????????????????80-80*20%=64???????????????????????????</div>
            <div style="margin-bottom: 20px">???????????????80-64=16???</div>
            <div>??????D?????????????????????[200/???100+200???]*60???40???</div>
            <div>??????D?????????????????????200-40=160???????????????????????????</div>
            <div>?????????????????????40/200=20%</div>
            <div>??????????????????180-180*20%=144???????????????????????????</div>
            <div>???????????????160-144=16???</div>
        </div>
        <span slot="footer" class="dialog-footer">
            <el-button size="small" type="primary" size="small" @click="dialogVisible = false">????????????</el-button>
        </span>
    </el-dialog>
</section>
<script>

    const _currentPluginBaseUrl =  `<?=$_currentPluginBaseUrl?>`;

    const app = new Vue({
        el: '#app',

        data() {
            var validateRate4 = (rule, value, callback) => {
                if (this.form.cash_service_charge === '' || this.form.cash_service_charge === undefined) {
                    callback(new Error('????????????????????????'));
                } else if (this.form.cash_service_charge > 100) {
                    callback(new Error('???????????????????????????100%'));
                } else {
                    callback();
                }
            };
            return {
                // tab??????
                activeName: 'first',
                //????????????loading
                loading: false,
                // ????????????loading
                btnLoading: false,
                dialogVisible: false,
                app_share: {
                    dialog: false,
                    type: ''
                },
                pay_type: ['auto'],
                form: {
                	is_apply: '1',
                    is_allow_change: '1',
                	is_apply_money: '1',
                	middleman: '',
                	sell_out_sort: '1',
                	app_share_title: '',
                	app_share_pic: '',
                	apply_money: '0',
                	apply_money_name: '???????????????',
                    poster_style: ['1'],
                    image_style: ['1'],
                    activity_poster_style: ['1'],
                    min_money: 0,
                    free_cash_min: '',
                    cash_service_charge: 0,
                    pay_type: [],
                },
                rules: {
                    min_money: [
                        { required: true, message: '??????????????????????????????', trigger: 'blur' }
                    ],
                    cash_service_charge: [
                        { validator: validateRate4, trigger: 'blur' }
                    ]
                },
                show_style: '1'
            };
        },

        methods: {
            delPic() {
                this.form.banner = '';
            },
            changeStyle(style) {
                const index = this.form.activity_poster_style.indexOf(style);
                if (index === -1) {
                    this.form.activity_poster_style.splice(index, 0, style);
                } else {
                    this.form.activity_poster_style.splice(index, 1)
                }
                this.show_style = parseInt(style);
            },
            topPicUrl(e) {
                this.form.banner = e[0].url;
            },
            imageBg(e) {
                this.form.image_bg = e[0].url;
            },
            resetImg(res) {
                if(res == 2) {
                    this.form.image_bg = this.form.default_image_bg;
                }else {
                    this.form.banner = this.form.default_banner;
                }
            },
            loadData() {
                this.loading = true;
                request({
                    params: {
                        r: 'plugin/community/mall/setting/setting-data',
                    },
                    method: 'get',
                }).then(e => {
                    this.loading = false;
                    if (e.data.code == 0) {
                        this.form = e.data.data;
                        this.pay_type = this.form.pay_type;
                        if(this.form.pay_type.length == 0) {
                            this.pay_type = ['auto']
                        }
                    } else {
                        this.$message.error(e.data.msg);
                    }
                }).catch(e => {
                    this.loading = false;
                });
            },
        	onSubmit(formName) {
                let that = this;
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        that.btnLoading = true;
                        let para = that.form;
                        para.pay_type = [];
                        if(that.pay_type.indexOf('balance') > -1) {
                            para.pay_type.push('balance')
                        }
                        if(that.pay_type.indexOf('bank') > -1) {
                            para.pay_type.push('bank')
                        }
                        if(that.pay_type.indexOf('alipay') > -1) {
                            para.pay_type.push('alipay')
                        }
                        if(that.pay_type.indexOf('wechat') > -1) {
                            para.pay_type.push('wechat')
                        }
                        if(that.pay_type.indexOf('auto') > -1 || that.pay_type.length == 0) {
                            para.pay_type.push('auto')
                        }
                        if(para.cash_service_charge == 0) {
                            para.free_cash_min = '';
                            para.free_cash_max = '';
                        }
                        request({
                            params: {
                                r: 'plugin/community/mall/setting/setting',
                            },
                            data: para,
                            method: 'post'
                        }).then(e => {
                            this.btnLoading = false;
                            if (e.data.code == 0) {
                                this.$message({
                                    message: e.data.msg,
                                    type: 'success'
                                });
                            } else {
                                this.$message.error(e.data.msg);
                            }
                        }).catch(e => {
                            this.btnLoading = false;
                        });
                    }
                })
        	}
        },

        created() {
            this.loadData();
        },
    })
</script>