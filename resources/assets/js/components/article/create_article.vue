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
        <el-form :model="form" ref="form"  label-width="80px">
            <el-form-item label="文章版权" prop="copyright">
                <el-select v-model="form.copyright" placeholder="请选择版权类型">
                    <el-option label="原创" value=1></el-option>
                    <el-option label="转载" value=2></el-option>
                    <el-option label="翻译" value=3></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="文章封面">
                <el-upload
                        class="avatar-uploader"
                        name="files"
                        :data="csrf_token"
                        action="/article/cover_upload"
                        :auto-upload="true"
                        :show-file-list="false"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload">
                    <img v-if="imageUrl" :src="imageUrl" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>
            <el-form-item label="文章标题" prop="title">
                <el-input v-model.trim="form.title"></el-input>
            </el-form-item>
            <el-form-item label="文章内容" prop="content">
                <el-row v-model.trim="form.content" id="summernote"></el-row>
            </el-form-item>
            <el-form-item label="文章标签" prop="dynamicTags_select">
                <el-row>
                    <el-col style="border: 1px solid rgb(191,217,207); border-radius: 3px; padding:0 10px; min-height: 38px;background-color: white">
                        <el-tag style="margin-right: 10px"
                            type="success"
                            v-for="(tag,index) in form.dynamicTags_select"
                            :key="tag.name"
                            :closable="true"
                            :close-transition="false"
                            @close="handleClose(tag,index)"
                        >
                            {{tag.name}}
                        </el-tag>
                        <span style="color: grey">最多添加5个标签</span>
                    </el-col>
                </el-row>
                <el-row>
                    <el-col style="border: 1px solid rgb(191,217,207); border-radius: 3px; padding:0 10px; min-height: 38px;background-color: white">
                        <el-form-item label="可选标签:">
                            <el-col>
                                <el-tag style="margin-right: 10px;"
                                        v-for="tag in dynamicTags"
                                        :key="tag.name"
                                        :closable="false"
                                        :type="tag.type"
                                        :close-transition="false"
                                >
                                    <span style="padding: 5px 12px; cursor: pointer;" @click = "allTagClick(tag)">{{tag.name}}</span>
                                </el-tag>
                                <span v-if="!dynamicTags.length">暂无</span>
                            </el-col>
                        </el-form-item>
                        <el-form-item label="添加标签:">
                            <el-input
                                    class="input-new-tag"
                                    v-if="inputVisible"
                                    v-model="inputValue"
                                    ref="saveTagInput"
                                    size="small"
                                    @keyup.enter.native="handleInputConfirm"
                                    @blur="handleInputConfirm"
                            >
                            </el-input>
                            <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 添加标签</el-button>
                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form-item>
            <el-form-item label="文章摘要" prop="summary">
                <el-input
                        type="textarea"
                        :maxlength='maxLength'
                        :rows="3"
                        placeholder="默认自动提取您文章的前200字显示在博客首页作为文章摘要，您也可以在这里自行编辑 "
                        v-model.trim="form.summary">
                </el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit(1)" :loading="isSubmiting">发布</el-button>
                <el-button type="primary" @click="onSubmit(0)">存为草稿</el-button>
                <!--<el-button type="primary" @click="resetForm('form')">舍弃</el-button>-->
                <el-button @click="giveUp" type="danger">舍弃</el-button>
            </el-form-item>
        </el-form>

    </div>
</template>
<style>
    .tips {
        margin-left: 10px;
       width: 500px;
       float: left;
    }
    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    .avatar-uploader .el-upload:hover {
        border-color: #20a0ff;
    }
    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }
    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
    .el-upload__input{
        display: none !important;
    }
</style>
<script>
    import index from "../../router/index";
    import Form from './data/form';
    export default {
        data() {
            return {
                csrf_token: {
                    _token: Laravel.csrfToken
                },
                form: {
                    copyright:  '',
                    title:      '',
                    coverName:  '',
                    content:    '',
                    summary:    '',
                    status:     1,
                    dynamicTags_select: [],
                },
                imageUrl:   '',
                dynamicTags: [],
                inputVisible: false,
                inputValue: '',
                maxLength: 300,
                isSubmiting:false
            }
        },
        methods: {
            test(){
                if(this.form.copyright.length === 0){
                    this.$message({
                        showClose: true,
                        message: '请选择版权类型',
                        type: 'warning'
                    });
                }else if(this.form.title.length === 0){
                    this.$message({
                        showClose: true,
                        message: '请填写文章标题',
                        type: 'warning'
                    });
                }else if(this.form.content.length === 0){
                    this.$message({
                        showClose: true,
                        message: '文章内容为空',
                        type: 'warning'
                    });
                }else {
                    return true;
                }
                return false;
            },
            onSubmit(type = 1) {
                var self = this;
                self.isSubmiting = true;
                self.form.status = type;
                self.form.content = $('#summernote').summernote('code');
                if(this.test()){
                    var form = new Form();
                    form.setSubmit(self.form, (result,error)=>{
                        if(result){
                            self.$message({
                                title: '提示',
                                message: result,
                                type: 'success'
                            });
                            //跳转
                            /*self.$router.push({
                                path: '/user/org'
                            })*/
                        }
                        else {
                            self.$message({
                                title: '提示',
                                message: error,
                                type: 'warning'
                            });
                        }
                    });
                }
                self.isSubmiting = false;
            },
            create_summernote(){
                $('#summernote').summernote({
                    lang : 'zh-CN',
                    minHeight : 250,
                    dialogsFade : true,
                    dialogsInBody : true,
                    disableDragAndDrop : false,
                });
            },
            handleAvatarSuccess(res, file) {
                if(res.code == 0){
                    this.imageUrl = URL.createObjectURL(file.raw);
                    this.form.coverName = res.result;
                } else {
                    this.$message.error(res.msg);
                }
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg' || file.type === 'image/png';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG/PNG 格式!');
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isJPG && isLt2M;
            },
            allTagClick(tag){
                self = this;
                let tagIndex = self.dynamicTags.indexOf(tag);
                if (tag.type == 'warning'){
                    if ( self.form.dynamicTags_select.length >= 5 )
                        return;
                    tag.type = 'success';
                    let newTag = {
                        name: tag.name,
                        tagIndex: tagIndex
                    };
                    self.form.dynamicTags_select.push(newTag);
                } else {
                    tag.type = 'warning';
                    self.form.dynamicTags_select.forEach(function(value, index, array) {
                        if(value.tagIndex == tagIndex){
                            array.splice(index,1);
                        }
                    })
                }
            },
            handleClose(tag,index) {
                if(tag.tagIndex >= 0)
                    this.dynamicTags[tag.tagIndex].type = 'warning';
                this.form.dynamicTags_select.splice(index, 1);
            },
            showInput() {
                this.inputVisible = true;
                this.$nextTick(_ => {
                    this.$refs.saveTagInput.$refs.input.focus();
                });
            },
            handleInputConfirm() {
                let inputValue = this.inputValue.trim();
                if (inputValue && this.form.dynamicTags_select.length < 5) {
                    let tag = {
                        name: inputValue,
                        tagIndex: -1
                    };
                    this.form.dynamicTags_select.push(tag);
                }
                this.inputVisible = false;
                this.inputValue = '';
            },
//            resetForm(formName) {
//                this.$refs[formName].resetFields();
//                this.dynamicTags = [];
//                $('#summernote').summernote('code','');
//            },
            giveUp(){
                let self = this;
                this.$confirm('确认放弃编辑吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(function () {
                    //跳转
                    /*self.$router.push({
                        path: '/user/org'
                    })*/
                }).catch(function (error) {
                })
            },
            getTag(){
                var self = this;
                var form = new Form();
                form.getTag((result,error)=>{
                    if(result){
                        result.forEach(function(value) {
                            value.type = 'warning';
                        });
                        self.dynamicTags = result;
                    }
                    else {
                        self.dynamicTags = [];
                        
                    }
                });
            }
        },
        mounted(){
            this.create_summernote();
            this.getTag();
        }
    };
</script>
