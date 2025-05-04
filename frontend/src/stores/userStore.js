import {defineStore} from "pinia";
import {useAuthStore} from "@/stores/authStore.js";

export const useUserStore = defineStore('userStore', () => {

    const auth = useAuthStore()

    const getUserRole = () => {
        return auth.state?.user?.role_code
    }

    return { getUserRole }
});
