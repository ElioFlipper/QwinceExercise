import axios from 'axios';
import router from './router';

const client = axios.create();

client.interceptors.request.use(function (config) {
    if (config.url.includes('login')) return config;

    const token = localStorage.getItem('token');

    if (token) config.headers.Authorization = `Bearer ${token}`;

    return config;
}, function (err) {
    return Promise.reject(err);
});

client.interceptors.response.use(
    (res) => res,
    function (err) {
        const res = err.response;
        if (!res.config.url.includes('login') && !res.config.url.includes('change-password')) {
            if (res.status == 401) {
                const hasToken = localStorage.hasToken('token')
                if (hasToken) {
                    localStorage.removeItem('token')
                }
                router.push('/login');
            }
        }
        return Promise.reject(err);
    });

export { client }