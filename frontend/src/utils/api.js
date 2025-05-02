import Cookies from 'js-cookie'
import axios from "axios";

const axiosInstance  = axios.create({
    baseURL: import.meta.env.VITE_BACKEND_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
    },
})

axiosInstance.defaults.withCredentials = true

axiosInstance.interceptors.request.use(async (config) => {
    if (config.method?.toLowerCase() !== 'get') {
        try {
            await axiosInstance.get('/csrf-cookie');
            const csrfToken = Cookies.get('XSRF-TOKEN');
            if (csrfToken) {
                config.headers['X-XSRF-TOKEN'] = decodeURIComponent(csrfToken);
            }
        } catch (error) {
            console.error('CSRF token request failed:', error);
        }
    }
    return config;
});


export default axiosInstance;
