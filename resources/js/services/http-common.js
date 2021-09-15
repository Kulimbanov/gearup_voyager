import axios from "axios";

let Api = axios.create({
    baseURL: process.env.MIX_APP_API + '/api',
    headers: {
        "Content-type": "application/json"
    }
});
Api.defaults.withCredentials = true;

export default Api;
