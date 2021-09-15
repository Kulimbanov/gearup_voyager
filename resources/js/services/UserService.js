import http from "./http-common";

class TodoDataService {
    get() {
        return http.get(`/user`)
    }

    create(data) {
        return http.post(`/user`, data);
    }

    update(id, data) {
        return http.put(`/user/${id}`, data);
    }

    login(data) {
        return http.post(`/login`, data);
    }
}

export default new TodoDataService();
