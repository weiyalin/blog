<template>
    <div>
        <!--头部位置-->
        <div class="my_breadcrumb">
            <i class="ion-ios-home home-ion"></i>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item to="/">首页</el-breadcrumb-item>
                <el-breadcrumb-item to="/">文章</el-breadcrumb-item>
                <el-breadcrumb-item>文章管理</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        
        <el-form :inline="true" @keydown.enter.native="getTableData">
            <el-form-item>
                <router-link to="/article/create_article"><el-button type="primary">写文章</el-button></router-link>
            </el-form-item>

            <el-form-item label="文章类型">
                    <el-select v-model="copyright" filterable clearable placeholder="请选择文章类型" @change="getTableData">
                    <el-option
                        v-for="item in copyrightData"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="标签">
                    <el-select v-model="tagId" filterable clearable placeholder="请选择标签" @change="getTableData">
                    <el-option
                        v-for="item in dynamicTags"
                        :key="item.id"
                        :label="item.name"
                        :value="item.id">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="关键字">
                <el-input v-model="keyword" placeholder="文章名称" icon="search"></el-input>
                <el-input style="display:none;"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" icon="search" @click="getTableData">查询</el-button>
            </el-form-item>
        </el-form>
        
        <el-table :data="tableData" style="width: 100%">

            <el-table-column prop="title" label="标题"></el-table-column>
            <el-table-column prop="copytight" label="文章类型"></el-table-column>
            <el-table-column prop="read_num" label="阅读"></el-table-column>
            <el-table-column prop="comment" label="评论"></el-table-column>
            <el-table-column prop="created_at" label="创建时间"></el-table-column>
            <el-table-column prop="updaed_at" label="更新时间"></el-table-column>

            <el-table-column label="操作">
                <template scope="scope">
                    <el-button size="small" type="primary" icon="edit" @click="exitDialog(scope.row.id)">修改</el-button>
                    <el-button size="small" type="danger" class="el-icon-delete" @click="deleteTag(scope.row.id)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <el-pagination
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page="currentPage"
            :page-sizes="[10, 20, 50, 100]"
            :page-size="pageSize"
            layout="total, sizes, prev, pager, next, jumper"
            :total="total">
        </el-pagination>
    </div>
</template>
<script>
    import Form from './data/form';
    export default {
        data(){
            return {
                copyright   : '',
                tableData   : [],
                dynamicTags : [],
                tagId       : '',
                keyword     : '',
                currentPage : 1,
                total       : 0,
                pageSize    : 10,
                copyrightData : [
                    { id : 1, name : '原创'},
                    { id : 2, name : '转载'},
                    { id : 3, name : '翻译'},
                ],
            }
        },
        methods: {
            handleSizeChange(val){
                this.pageSize = val;
                this.getTableData();
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.getTableData();
            },
            getTableData(){
                let self = this;
                axios.post('article/getArticleList',{
                    page     :self.currentPage,
                    per_page :self.pageSize,
                    keyword  :self.keyword,
                    copyright:self.copyright,
                    tagId    :self.tagId
                }).then((res) => {
                    let data = res.data;
                    if(data.code == 0){
                        // console.log(data.result);
                        self.tableData = data.result.data;
                        self.total = data.result.total;
                    }else{
                        self.$message({
                            title: '提示',
                            message: data.msg,
                            type: 'error'
                        });
                    }
                });
            },
            getTag(){
                var self = this;
                var form = new Form();
                form.getTag((result,error)=>{
                    if(result){
                        self.dynamicTags = result;
                    }
                    else {
                        self.dynamicTags = [];
                    }
                });
            }
        },
        mounted() {
            this.getTableData();
            this.getTag();
        }
    }
</script>