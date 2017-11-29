export default class Form {

    setSubmit(student,callback){
        Vue.http.post('article/create',student).then(function (response) {
            var message = response.data["msg"];
            if(response.data.code == 0){
                callback(message,false);
            }
            else {
                callback(false,message)
            }

        }, function (error) {
            callback(false,error);
        });
    }

    getTag(callback){
        Vue.http.get('article/getTag').then(function (response) {
            var result = response.data["result"];
            var msg    = response.data["msg"];
            if(response.data.code == 0){
                callback(result,false);
            }
            else {
                callback(false,msg)
            }

        }, function (error) {
            callback(false,error);
        });
    }
}

