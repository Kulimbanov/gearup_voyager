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
}

export default new TodoDataService();
