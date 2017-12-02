<template>
    <div>
        <!--头部位置-->
        <div class="my_breadcrumb">
            <i class="ion-ios-home home-ion"></i>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item to="/">首页</el-breadcrumb-item>
                <el-breadcrumb-item to="/">文章</el-breadcrumb-item>
                <el-breadcrumb-item>标签管理</el-breadcrumb-item>
            </el-breadcrumb>
        </div>

        <el-form :inline="true" @keydown.enter.native="getTableData">
            <el-form-item>
                <el-button><i class="ion-plus"></i> 添加标签</el-button>
            </el-form-item>
            <el-form-item label="关键字">
                <el-input v-model="keyword" placeholder="标签名称" icon="search"></el-input>
                <el-input style="display:none;"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" icon="search" @click="getTableData">查询</el-button>
            </el-form-item>
        </el-form>

        <el-table :data="tableData" style="width: 100%">

            <el-table-column prop="id" label="id"></el-table-column>
            <el-table-column prop="name" label="名称"></el-table-column>
            <el-table-column prop="rate" label="频率"></el-table-column>
            <el-table-column prop="created_at" label="创建时间"></el-table-column>
            <el-table-column prop="updaed_at" label="更新时间"></el-table-column>

            <el-table-column label="操作">
                <template scope="scope">
                    <el-button size="small" type="primary" icon="edit">修改</el-button>
                    <el-button size="small" type="danger" class="el-icon-delete">删除</el-button>
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
    export default {
        data(){
            return {
                tableData   : [],
                keyword     : '',
                currentPage : 1,
                total       : 0,
                pageSize    : 10,
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
                let query = {page:self.currentPage,per_page:self.pageSize,keyword:self.keyword};
                axios.get('article/getTagList',{params:query}).then((res) => {
                    let data = res.data;
                    if(data.code == 0){
                        self.tableData = data.result.data;
                        self.total = data.result.total;
                    }else{
                        self.$message({
                            title: '提示',
                            message: data.msg,
                            type: 'error'
                        });
                    }
                })
            },
        },
        mounted() {
            this.getTableData();
        }
    }
</script>
