<template>
    <div>
        <!--头部位置-->
        <div class="my_breadcrumb">
            <i class="ion-ios-home home-ion"></i>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item to="/">首页</el-breadcrumb-item>
                <el-breadcrumb-item to="/">文章</el-breadcrumb-item>
                <el-breadcrumb-item>写文章</el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="文章版权">
                <el-select v-model="form.region" placeholder="请选择版权类型">
                    <el-option label="原创" value=1></el-option>
                    <el-option label="转载" value=2></el-option>
                    <el-option label="翻译" value=3></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="文章内容">
                <div id="summernote"></div>
            </el-form-item>
            <!--<el-form-item label="时间">-->
                <!--<el-col :span="11">-->
                    <!--<el-date-picker type="date" placeholder="选择日期" v-model="form.date1" style="width: 100%;"></el-date-picker>-->
                <!--</el-col>-->
                <!--<el-col class="line" :span="2">-</el-col>-->
                <!--<el-col :span="11">-->
                    <!--<el-time-picker type="fixed-time" placeholder="选择时间" v-model="form.date2" style="width: 100%;"></el-time-picker>-->
                <!--</el-col>-->
            <!--</el-form-item>-->
            <el-form-item label="即时配送">
                <el-switch on-text="" off-text="" v-model="form.delivery"></el-switch>
            </el-form-item>
            <el-form-item label="活动性质">
                <el-checkbox-group v-model="form.type">
                    <el-checkbox label="美食/餐厅线上活动" name="type"></el-checkbox>
                    <el-checkbox label="地推活动" name="type"></el-checkbox>
                    <el-checkbox label="线下主题活动" name="type"></el-checkbox>
                    <el-checkbox label="单纯品牌曝光" name="type"></el-checkbox>
                </el-checkbox-group>
            </el-form-item>
            <el-form-item label="特殊资源">
                <el-radio-group v-model="form.resource">
                    <el-radio label="线上品牌商赞助"></el-radio>
                    <el-radio label="线下场地免费"></el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="活动形式">
                <el-input type="textarea" v-model="form.desc"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">立即创建</el-button>
                <el-button>取消</el-button>
            </el-form-item>
        </el-form>

    </div>
</template>
<script>
    export default {
        data() {
            return {
                form: {
                    name: '',
                    region: '',
                    date1: '',
                    date2: '',
                    delivery: false,
                    type: [],
                    resource: '',
                    desc: ''
                },
                placeholder:'请输入文章内容......'
            }
        },

        methods: {
            onSubmit() {
                console.log('submit!');
            },
            create_summernote(){
                $('#summernote').summernote({
                    lang : 'zh-CN',
                    placeholder : this.placeholder,
                    minHeight : 250,
                    dialogsFade : true,
                    dialogsInBody : true,
                    disableDragAndDrop : false,
                });
            }
        },
        mounted(){
            this.create_summernote();
        }
    };
</script>
