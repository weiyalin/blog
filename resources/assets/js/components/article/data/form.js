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
            console.log(error);
            callback(false,error);
        });
    }
}

