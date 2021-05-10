<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2019/5/8
 * Time: 11:02
 */
Yii::$app->loadViewComponent('diy/diy-bg');
?>
<style>
    .diy-flash-sale .diy-component-edit .goods-list {
        line-height: normal;
        flex-wrap: wrap;
    }

    .diy-flash-sale .diy-component-edit .goods-item,
    .diy-flash-sale .diy-component-edit .goods-add {
        width: 50px;
        height: 50px;
        border: 1px solid #e2e2e2;
        background-position: center;
        background-size: cover;
        margin-right: 15px;
        margin-bottom: 15px;
        position: relative;
    }

    .diy-flash-sale .diy-component-edit .goods-add {
        cursor: pointer;
    }

    .diy-flash-sale .diy-component-edit .goods-delete {
        position: absolute;
        top: -11px;
        right: -11px;
        width: 25px;
        height: 25px;
        line-height: 25px;
        padding: 0 0;
        visibility: hidden;
    }

    .diy-flash-sale .diy-component-edit .goods-item:hover .goods-delete {
        visibility: visible;
    }

    /*-------------------- 预览部分 --------------------*/
    .diy-flash-sale .diy-component-preview .goods-list {
        flex-wrap: wrap;
        /* background-color: #fff; */
        padding: 10px;
    }

    .diy-flash-sale .diy-component-preview .goods-item {
        position: relative;
    }

    .diy-flash-sale .diy-component-preview .goods-tag {
        position: absolute;
        top: 0;
        left: 0;
        width: 64px;
        height: 64px;
        background-position: center;
        background-size: cover;
    }

    .diy-flash-sale .diy-component-preview .goods-pic {
        width: 100%;
        height: 706px;
        background-color: #e2e2e2;
        background-position: center;
        background-size: cover;
        position: relative;
        background-repeat: no-repeat;
    }

    .diy-flash-sale .diy-component-preview .goods-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .diy-flash-sale .diy-component-preview .goods-name.goods-two {
        word-break: break-all;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        white-space: normal !important;
    }

    .diy-flash-sale .diy-component-preview .goods-cover-3-2 .goods-pic {
        height: 470px;
    }

    .diy-flash-sale .diy-component-preview .goods-list-2 .goods-pic {
        height: 343px;
    }

    .diy-flash-sale .diy-component-preview .goods-list--1 .goods-pic {
        width: 200px;
        height: 200px;
        margin-right: 20px;
    }

    .diy-flash-sale .diy-component-preview .goods-list--1 .goods-item {
        margin-bottom: 20px;
    }

    .diy-flash-sale .diy-component-preview .goods-list--1 .goods-item:last-child {
        margin-bottom: 0;
    }

    .diy-flash-sale .diy-component-preview .goods-name-static {
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        word-break: break-all;
        margin-bottom: 12px;
    }

    .diy-flash-sale .diy-component-preview .goods-price {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #ff4544;
        line-height: 48px;
    }

    .diy-flash-sale .diy-component-preview .goods-miaosha-timer {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 80px;
        line-height: 80px;
        padding: 0 20px;
        background: -webkit-linear-gradient(left, #f44, #ff8b8b);
        background: -webkit-gradient(linear, left top, right top, from(#f44), to(#ff8b8b));
        background: -moz-linear-gradient(left, #f44, #ff8b8b);
        background: linear-gradient(90deg, #f44, #ff8b8b);
        color: #fff;
    }

    .diy-flash-sale .plugin-name {
        height: 28px;
        line-height: 28px;
        padding: 0 8px;
        color: #ff4544;
        font-size: 24px;
        background-color: #feeeee;
        border-radius: 14px;
        margin-right: 8px;
    }
    .diy-flash-sale .discount {
        height: 28px;
        line-height: 28px;
        border-radius: 14px;
        background-color: #ff4544;
        font-size: 24px;
        text-align: center;
        padding: 0 8px;
        color: #ffffff;
    }
    .diy-flash-sale .option {
        opacity: 0;
    }
    .diy-flash-sale .progress_bar {
        background-color: #ffb7b7;
        display: inline-block;
        height: 16px;

        border-radius: 8px;
    }
</style>
<template id="diy-flash-sale">
    <div class="diy-flash-sale">
        <div class="diy-component-preview" :style="cListStyle">
            <div class="goods-list" :class="'goods-list-'+data.listStyle" :flex="cListFlex">
                <div v-for="item in cList" style="padding: 10px;" :style="cItemStyle">
                    <div class="goods-item"
                         :flex="cGoodsFlex"
                         :class="'goods-cover-'+data.goodsCoverProportion"
                         :style="cGoodsStyle">
                        <div class="goods-pic" :style="cGoodsPicStyle(item.picUrl)">
                            <div :style="cTimerStyle" :flex="cTimerFlex" class="goods-miaosha-timer"
                                 v-if="data.listStyle===1 || data.listStyle===2">
                                <div v-if="data.listStyle===1">限时抢购</div>
                                <div>距结束 xx:xx:xx</div>
                            </div>
                        </div>
                        <div v-if="data.showGoodsTag" class="goods-tag"
                             :style="'background-image: url('+data.goodsTagPicUrl+');'"></div>
                        <div :style="cGoodsInfoStyle">
                            <div class="goods-name" :class="data.listStyle!==-1 ? data.listStyle == 1 ? 'goods-two' : '':'goods-name-static'">
                            <template v-if="data.showGoodsName"><span v-if="data.listStyle!=1" class="plugin-name">限时抢购</span>{{item.name}}</template>
                            </div>
                            <div v-if="data.listStyle===-1"  >
                               <div flex="dir:left main:justify">
                                    <span class="discount" v-if="item.discount_type === 1">
                                        {{item.min_discount}}折
                                    </span>
                                   <span class="discount" v-if="item.discount_type === 2">
                                        减{{item.min_discount}}元
                                    </span>
                                   <span :class="data.showProgressBar ? '' : 'option'" style="margin-left: 15px;color: #909399;font-size: 24px;">已抢0件</span>
                               </div>
                                <div v-if="data.showProgressBar"  style="width: 450px;" class="progress_bar"></div>
                            </div>
                            <div v-if="data.listStyle === 1 || data.listStyle === 2">
                                <div>
                                    <span class="discount" v-if="item.discount_type === 1">
                                        {{item.min_discount}}折起
                                    </span>
                                    <span class="discount" v-if="item.discount_type === 2">
                                        减{{item.min_discount}}元
                                    </span>
                                </div>
                                <div v-if="data.showProgressBar" class="progress_bar" style="width: 100%;"></div>
                                <div v-if="data.showProgressBar">
                                    <span style="color: #909399;font-size: 24px;">
                                        已抢0件
                                    </span>
                                </div>
                            </div>
                            <div flex="box:last cross:bottom">
                                <div class="goods-price" :style="cPriceStyle">
                                   <template v-if="data.listStyle === 1 || data.listStyle === 2 || (!data.showProgressBar && data.listStyle === -1)">
                                       <div style="color: #ff4544;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;letter-spacing: -1px;">
                                           <span>￥{{item.price}}</span>
                                       </div>
                                       <div v-if="data.isUnderLinePrice" style="color: #909399;text-decoration: line-through;font-size: 24px;line-height: 1">
                                           <span>￥{{item.originalPrice}}</span>
                                       </div>
                                   </template>
                                    <template v-else-if="data.listStyle === -1 && data.showProgressBar">
                                        <span style="color: #ff4544;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;letter-spacing: -1px;">￥{{item.price}}</span>
                                        <span v-if="data.isUnderLinePrice" style="color: #909399;text-decoration: line-through;font-size: 24px;line-height: 1">￥{{item.originalPrice}}</span>
                                    </template>
                                </div>
                                <div v-if="cShowBuyBtn" style="padding: 0 10px;">
                                    <el-button :style="cButtonStyle" type="primary" style="font-size: 24px;">{{data.buyBtnText}}</el-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="diy-component-edit">
            <el-form @submit.native.prevent label-width="150px">
                <el-form-item label="商品列表">
                    <draggable class="goods-list" flex v-model="data.list" ref="parentNode">
                        <div class="goods-item drag-drop" v-for="(goods,goodsIndex) in data.list"
                             :style="'background-image: url('+goods.picUrl+');'">
                            <el-button @click="deleteGoods(goodsIndex)" class="goods-delete"
                                       size="small" circle type="danger"
                                       icon="el-icon-close"></el-button>
                        </div>
                        <div class="goods-add" flex="main:center cross:center"
                             @click="goodsDialog.visible=true">
                            <i class="el-icon-plus"></i>
                        </div>
                    </draggable>
                </el-form-item>
                <el-form-item label="购买按钮颜色">
                    <el-color-picker v-model="data.buttonColor"></el-color-picker>
                </el-form-item>
                <el-form-item label="列表样式">
                    <app-radio v-model="data.listStyle" :label="-1" @change="listStyleChange">列表模式</app-radio>
                    <app-radio v-model="data.listStyle" :label="1" @change="listStyleChange">一行一个</app-radio>
                    <app-radio v-model="data.listStyle" :label="2" @change="listStyleChange">一行两个</app-radio>
                </el-form-item>
                <el-form-item label="商品封面图宽高比例" v-if="data.listStyle==1">
                    <app-radio v-model="data.goodsCoverProportion" label="1-1">1:1</app-radio>
                    <app-radio v-model="data.goodsCoverProportion" label="3-2">3:2</app-radio>
                </el-form-item>
                <el-form-item label="商品封面图填充">
                    <app-radio v-model="data.fill" :label="1">填充</app-radio>
                    <app-radio v-model="data.fill" :label="0">留白</app-radio>
                </el-form-item>
                <el-form-item label="商品样式">
                    <app-radio v-model="data.goodsStyle" :label="1">白底无边框</app-radio>
                    <app-radio v-model="data.goodsStyle" :label="2">白底有边框</app-radio>
                    <app-radio v-model="data.goodsStyle" :label="3">无底无边框</app-radio>
                </el-form-item>
                <el-form-item label="显示商品名称">
                    <el-switch v-model="data.showGoodsName"></el-switch>
                </el-form-item>
                <el-form-item v-if="data.listStyle!==-1" label="文本样式">
                    <app-radio v-model="data.textStyle" :label="1">左对齐</app-radio>
                    <app-radio v-model="data.textStyle" :label="2">居中</app-radio>
                </el-form-item>
                    <el-form-item label="显示购买按钮" v-if="cShowEditBuyBtn">
                        <el-switch v-model="data.showBuyBtn"></el-switch>
                    </el-form-item>
                <el-form-item label="显示抢购进度条">
                    <el-switch v-model="data.showProgressBar"></el-switch>
                </el-form-item>
                    <el-form-item v-if="data.showBuyBtn && cShowEditBuyBtn" label="购买按钮样式">
                        <app-radio v-model="data.buyBtnStyle" :label="1">填充</app-radio>
                        <app-radio v-model="data.buyBtnStyle" :label="2">线条</app-radio>
                        <app-radio v-model="data.buyBtnStyle" :label="3">圆角填充</app-radio>
                        <app-radio v-model="data.buyBtnStyle" :label="4">圆角线条</app-radio>
                    </el-form-item>
                    <el-form-item v-if="data.showBuyBtn && cShowEditBuyBtn" label="购买按钮文字">
                        <el-input maxlength="4" size="small" v-model="data.buyBtnText"></el-input>
                    </el-form-item>

<!--                <el-form-item v-if="data.showBuyBtn" label="购买按钮样式">-->
<!--                    <app-radio v-model="data.buyBtnStyle" :label="1">填充</app-radio>-->
<!--                    <app-radio v-model="data.buyBtnStyle" :label="2">线条</app-radio>-->
<!--                    <app-radio v-model="data.buyBtnStyle" :label="3">圆角填充</app-radio>-->
<!--                    <app-radio v-model="data.buyBtnStyle" :label="4">圆角线条</app-radio>-->
<!--                </el-form-item>-->
<!--                <el-form-item v-if="data.showBuyBtn" label="购买按钮文字">-->
<!--                    <el-input maxlength="4" size="small" v-model="data.buyBtnText"></el-input>-->
<!--                </el-form-item>-->
                <el-form-item label="显示商品角标">
                    <el-switch v-model="data.showGoodsTag"></el-switch>
                </el-form-item>
                <el-form-item label="商品角标样式" v-if="data.showGoodsTag">
                    <app-radio v-model="data.goodsTagPicUrl" v-for="tag in goodsTags" :label="tag.picUrl" :key="tag.name"
                               @change="goodsTagChange">
                        {{tag.name}}
                    </app-radio>
                    <app-radio v-model="data.customizeGoodsTag" :label="true" @change="customizeGoodsTagChange">自定义
                    </app-radio>
                </el-form-item>
                <el-form-item label="自定义商品角标" v-if="data.showGoodsTag&&data.customizeGoodsTag">
                    <app-image-upload width="64" height="64" v-model="data.goodsTagPicUrl"></app-image-upload>
                </el-form-item>
                <el-form-item label="显示划线价" v-if="[-1,1,2].indexOf(data.listStyle) != -1">
                    <el-switch v-model="data.isUnderLinePrice"></el-switch>
                </el-form-item>
                <diy-bg :hr="false" :data="data" @update="updateData" @toggle="toggleData" @change="changeData"></diy-bg>
            </el-form>
        </div>
        <el-dialog title="选择商品" :visible.sync="goodsDialog.visible" @open="goodsDialogOpened">
            <el-input size="mini" v-model="goodsDialog.keyword" placeholder="根据名称搜索" :clearable="true"
                      @clear="loadGoodsList(1)" @keyup.enter.native="loadGoodsList(1)">
                <el-button slot="append" @click="loadGoodsList(1)">搜索</el-button>
            </el-input>
            <el-table :data="goodsDialog.list" v-loading="goodsDialog.loading" @selection-change="goodsSelectionChange">
                <el-table-column type="selection" width="50px"></el-table-column>
                <el-table-column label="ID" prop="id" width="100px"></el-table-column>
                <el-table-column label="名称" prop="name"></el-table-column>
            </el-table>
            <div style="text-align: center">
                <el-pagination
                    v-if="goodsDialog.pagination"
                    style="display: inline-block"
                    background
                    @current-change="goodsDialogPageChange"
                    layout="prev, pager, next"
                    :page-size.sync="goodsDialog.pagination.pageSize"
                    :total="goodsDialog.pagination.totalCount">
                </el-pagination>
            </div>
            <div slot="footer">
                <el-button type="primary" @click="addGoods">确定</el-button>
            </div>
        </el-dialog>
    </div>
</template>
<script>
    Vue.component('diy-flash-sale', {
        template: '#diy-flash-sale',
        props: {
            value: Object,
        },
        data() {
            return {
                goodsDialog: {
                    visible: false,
                    page: 1,
                    keyword: '',
                    loading: false,
                    list: [],
                    pagination: null,
                    selected: null,
                },
                goodsTags: [
                    {
                        name: '热销',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-rx.png',
                    },
                    {
                        name: '新品',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-xp.png',
                    },
                    {
                        name: '折扣',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-zk.png',
                    },
                    {
                        name: '推荐',
                        picUrl: _currentPluginBaseUrl + '/images/goods-tag-tj.png',
                    },
                ],
                data: {
                    buttonColor: '#ff4544',
                    list: [],
                    listStyle: 1,
                    fill: 1,
                    goodsCoverProportion: '1-1',
                    goodsStyle: 1,
                    textStyle: 1,
                    showGoodsName: true,
                    showBuyBtn: true,
                    buyBtnStyle: 1,
                    buyBtnText: '马上抢',
                    showGoodsTag: false,
                    customizeGoodsTag: false,
                    goodsTagPicUrl: '',
                    showImg: false,
                    backgroundColor: '#fff',
                    backgroundPicUrl: '',
                    position: 5,
                    mode: 1,
                    backgroundHeight: 100,
                    backgroundWidth: 100,
                    showProgressBar: false,
                    isUnderLinePrice: true,
                },
                position: 'center center',
                repeat: 'no-repeat',
            };
        },
        created() {
            if (!this.value) {
                this.$emit('input', JSON.parse(JSON.stringify(this.data)))
            } else {
                this.data = JSON.parse(JSON.stringify(this.value));
            }
        },
        computed: {
            cListStyle() {
                if(this.data.backgroundColor) {
                    return `background-color:${this.data.backgroundColor};background-image:url(${this.data.backgroundPicUrl});background-size:${this.data.backgroundWidth}% ${this.data.backgroundHeight}%;background-repeat:${this.repeat};background-position:${this.position}`
                }else {
                    return `background-image:url(${this.data.backgroundPicUrl});background-size:${this.data.backgroundWidth}% ${this.data.backgroundHeight}%;background-repeat:${this.repeat};background-position:${this.position}`
                }
            },
            cList() {
                if (!this.data.list || !this.data.list.length) {
                    return [
                        {
                            id: 0,
                            name: '演示商品名称',
                            picUrl: '',
                            price: '100.00',
                            originalPrice: '300.00',
                            min_discount: '10',
                            discount_type: 1
                        },
                        {
                            id: 0,
                            name: '演示商品名称',
                            picUrl: '',
                            price: '100.00',
                            originalPrice: '300.00',
                            min_discount: '0',
                            discount_type: 2
                        },
                    ];
                } else {
                    return this.data.list;
                }
            },
            cListFlex() {
                if (this.data.listStyle === -1) {
                    return 'dir:top';
                } else {
                    return 'dir:left';
                }
            },
            cItemStyle() {
                if (this.data.listStyle === 2) {
                    return 'width: 50%;';
                } else {
                    return 'width: 100%;';
                }
            },
            cGoodsStyle() {
                let style = 'border-radius:5px;';
                if (this.data.goodsStyle === 2) {
                    style += 'border: 1px solid #e2e2e2;';
                }
                if (this.data.goodsStyle != 3) {
                    style += 'background-color:#ffffff';
                }
                return style;
            },
            cGoodsInfoStyle() {
                let style = 'position:relative;';
                if (this.data.listStyle !== -1) {
                    style += 'padding:20px;';
                }else {
                    style += 'padding: 15px 20px 0 0;';
                }
                if (this.data.textStyle === 2) {
                    style += 'text-align: center;';
                }
                return style;
            },
            cPriceStyle() {
                let style = 'margin-top: 10px;';
                if (this.data.textStyle === 2) {
                    style += 'text-align: center;width: 100%;';
                } else if (this.data.textStyle === -1) {
                    style = '';
                }
                return style;
            },
            cGoodsFlex() {
                if (this.data.listStyle === -1) {
                    return 'dir:left box:first';
                } else {
                    return 'dir:top';
                }
            },
            cButtonStyle() {
                console.log(this.data.buyBtnStyle);
                let style = `background: ${this.data.buttonColor};border-color: ${this.data.buttonColor};height:48px;line-height:50px;padding: 0 20px;`;
                if (this.data.buyBtnStyle === 3 || this.data.buyBtnStyle === 4) {
                    style += `border-radius:24px;`;
                }
                if (this.data.buyBtnStyle === 2 || this.data.buyBtnStyle === 4) {
                    style += `background:#fff;color:${this.data.buttonColor}`;
                }
                return style;
            },
            cTimerStyle() {
                if (this.data.listStyle === 2) {
                    return 'height:60px;line-height:60px;font-size:24px;text-align:center;';
                } else {
                    return '';
                }
            },
            cTimerFlex() {
                if (this.data.listStyle === 2) {
                    return 'main:center';
                } else {
                    return 'box:last';
                }
            },
            cShowBuyBtn() {
                return this.data.textStyle !== 2
                    && this.data.showBuyBtn;
            },
            cShowEditBuyBtn() {
                return this.data.textStyle !== 2
            },
        },
        watch: {
            data: {
                deep: true,
                handler(newVal, oldVal) {
                    this.$emit('input', newVal, oldVal)
                },
            }
        },
        methods: {
            updateData(e) {
                this.data = e;
            },
            toggleData(e) {
                this.position = e;
            },
            changeData(e) {
                this.repeat = e;
            },
            cGoodsPicStyle(picUrl) {
                let style = `background-image: url(${picUrl});`
                    + `background-size: ${(this.data.fill === 1 ? 'cover' : 'contain')};`;
                return style;
            },
            listStyleChange(listStyle) {
                if (listStyle === -1 && this.data.textStyle === 2) {
                    this.data.textStyle = 1;
                }
            },
            goodsDialogOpened() {
                this.loadGoodsList(1);
            },
            loadGoodsList(page = 1) {
                this.goodsDialog.loading = true;
                this.$request({
                    params: {
                        r: 'plugin/diy/mall/template/get-goods',
                        page: page,
                        keyword: this.goodsDialog.keyword,
                        sign: 'flash_sale',
                    }
                }).then(response => {
                    this.goodsDialog.loading = false;
                    if (response.data.code === 0) {
                        this.goodsDialog.list = response.data.data.list;
                        this.goodsDialog.pagination = response.data.data.pagination;
                    }
                }).catch(e => {
                });
            },
            goodsDialogPageChange(page) {
                this.loadGoodsList(page);
            },
            goodsSelectionChange(e) {
                if (e && e.length) {
                    this.goodsDialog.selected = e;
                } else {
                    this.goodsDialog.selected = null;
                }
            },
            addGoods() {
                if (!this.goodsDialog.selected || !this.goodsDialog.selected.length) {
                    this.goodsDialog.visible = false;
                    return;
                }
                for (let i in this.goodsDialog.selected) {
                    const item = {
                        id: this.goodsDialog.selected[i].id,
                        name: this.goodsDialog.selected[i].name,
                        picUrl: this.goodsDialog.selected[i].cover_pic,
                        price: this.goodsDialog.selected[i].price,
                        originalPrice: this.goodsDialog.selected[i].original_price,
                        min_discount: this.goodsDialog.selected[i].min_discount,
                        discount_type: this.goodsDialog.selected[i].discount_type
                    };
                    this.data.list.push(item);
                }
                this.goodsDialog.selected = null;
                this.goodsDialog.visible = false;
            },
            deleteGoods(index) {
                this.data.list.splice(index, 1);
            },
            goodsTagChange(e) {
                this.data.goodsTagPicUrl = e;
                this.data.customizeGoodsTag = false;
            },
            customizeGoodsTagChange() {
                this.data.goodsTagPicUrl = '';
                this.data.customizeGoodsTag = true;
            },
        }
    });
</script>
