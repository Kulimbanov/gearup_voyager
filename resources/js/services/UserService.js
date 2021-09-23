import http from "./http-common";

class TodoDataService {
    get() {
        return http.get(`/user`)
    }

    register(data) {
        return http.post(`/register`, data);
    }

    logout() {
        return http.get('/sanctum/csrf-cookie').then(response => {
            return http.post(`/logout`)
                .then(response => {
                    if (response.data.success) {
                        window.location.href = "/"
                    } else {
                        console.log(response)
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    }

    login(data) {
        return http.post(`/login`, data);
    }

    forgotPassword(data) {
        return http.post(`/password`, data);
    }

    resetPassword(data, token) {
        if (token) {
            http.defaults.headers.common['Authorization'] = token;
        } else {
            http.defaults.headers.common['Authorization'] = null;
            /*if setting null does not remove `Authorization` header then try
              delete axios.defaults.headers.common['Authorization'];
            */
        }
        return http.post('/password/reset', data);
    }
}

export default new TodoDataService();
