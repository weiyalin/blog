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
                        action="https://jsonplaceholder.typicode.com/posts/"
                        :auto-upload="false"
                        :show-file-list="false"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload">
                    <img v-if="imageUrl" :src="imageUrl" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>
            <el-form-item label="文章标题">
                <el-input v-model="form.title"></el-input>
            </el-form-item>
            <el-form-item label="文章内容">
                <div v-model="form.content" id="summernote"></div>
            </el-form-item>
            <el-form-item label="文章标签">
                <el-row>
                    <el-col style="border: 1px solid rgb(191,217,207); border-radius: 3px; padding:0 10px; min-height: 38px;background-color: white">
                        <el-tag style="margin-right: 10px"
                            type="success"
                            v-for="tag,index in dynamicTags_select"
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
                        <el-row>
                            <el-col>全部标签:</el-col>
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
                            </el-col>
                        </el-row>
                        <el-row>
                            <el-input
                                class="input-new-tag"
                                v-if="inputVisible"
                                v-model="inputValue"
                                ref="saveTagInput"
                                size="mini"
                                @keyup.enter.native="handleInputConfirm"
                                @blur="handleInputConfirm"
                            >
                            </el-input>
                            <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 添加标签</el-button>
                        </el-row>
                    </el-col>
                </el-row>
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

    export default {
        data() {
            return {
                form: {
                    copyright: '',
                    title: '',
                    content: '',
                },
                imageUrl: '',

                dynamicTags_select: [],
                dynamicTags: [
                    { name: '标签一', type: 'warning' },
                    { name: '标签二', type: 'warning' },
                    { name: '标签三', type: 'warning' },
                    { name: '标签四', type: 'warning' },
                    { name: '标签五', type: 'warning' },
                    { name: '标签六', type: 'warning' }
                ],
                inputVisible: false,
                inputValue: '',
            }
        },

        methods: {
            onSubmit() {
                console.log('submit!');
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
                this.imageUrl = URL.createObjectURL(file.raw);
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg' || file.type === 'image/png';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('上传头像图片只能是 JPG 格式!');
                }
                if (!isLt2M) {
                    this.$message.error('上传头像图片大小不能超过 2MB!');
                }
                return isJPG && isLt2M;
            },

            //TODO::完善标签添加
            allTagClick(tag){
                self = this;
                let tagIndex = self.dynamicTags.indexOf(tag);
                if (tag.type == 'warning'){
                    if ( self.dynamicTags_select.length >= 5 )
                        return;
                    tag.type = 'success';
                    let newTag = {
                        name: tag.name,
                        tagIndex: tagIndex
                    };
                    self.dynamicTags_select.push(newTag);
                } else {
                    tag.type = 'warning';
                    self.dynamicTags_select.forEach(function(value, index, array) {
                        if(value.tagIndex == tagIndex){
                            array.splice(index,1);
                        }
                    })
                }
            },
            handleClose(tag,index) {
                if(tag.tagIndex >= 0)
                    this.dynamicTags[tag.tagIndex].type = 'warning';
                this.dynamicTags_select.splice(index, 1);
            },

            showInput() {
                this.inputVisible = true;
                this.$nextTick(_ => {
                    this.$refs.saveTagInput.$refs.input.focus();
                });
            },

            handleInputConfirm() {
                let inputValue = this.inputValue.trim();
                if (inputValue && this.dynamicTags_select.length < 5) {
                    let tag = {
                        name: inputValue,
                        tagIndex: -1
                    };
                    this.dynamicTags_select.push(tag);
                }
                this.inputVisible = false;
                this.inputValue = '';
            }
        },
        mounted(){
            this.create_summernote();
        }
    };
</script>
