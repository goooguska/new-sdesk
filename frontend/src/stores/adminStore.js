import {defineStore} from "pinia";
import {ref} from "vue";
import axiosInstance from "@/utils/api.js";

export const useAdminStore = defineStore('adminStore', () => {

    const adminEntities = [
        {
            name: "Статусы",
            code: "statuses"
        },

        {
            name: "Роли",
            code: "roles"
        },

        {
            name: "Категории",
            code: "categories"
        },

        {
            name: "Пользователи",
            code: "users"
        },

        {
            name: "Заявки",
            code: "tickets"
        },
    ]

    const statuses = ref([]);
    const categories = ref([]);
    const roles = ref([]);
    const users = ref([]);
    const tickets = ref([]);

    const getAllStatuses = async () => {
        try {
            const { data } = await axiosInstance.get('/admin/statuses');
            if (data?.data) {
                statuses.value = data.data;
            } else {
                console.error("Данные статусов не найдены в ответе API.");
            }
        } catch (error) {
            console.error("Ошибка при получении статусов:", error);
        }
    };

    const getAllRoles = async () => {
        try {
            const { data } = await axiosInstance.get('/admin/roles');
            if (data?.data) {
                roles.value = data.data;
            } else {
                console.error("Данные ролей не найдены в ответе API.");
            }
        } catch (error) {
            console.error("Ошибка при получении ролей:", error);
        }
    };

    const getAllCategories = async () => {
        try {
            const { data } = await axiosInstance.get('/admin/categories');
            if (data?.data) {
                categories.value = data.data;
            } else {
                console.error("Данные категорий не найдены в ответе API.");
            }
        } catch (error) {
            console.error("Ошибка при получении категорий:", error);
        }
    };

    const getAllUsers = async () => {
        try {
            const { data } = await axiosInstance.get('/admin/users');
            if (data?.data) {
                users.value = data.data;
            } else {
                console.error("Данные пользователей не найдены в ответе API.");
            }
        } catch (error) {
            console.error("Ошибка при получении пользователей:", error);
        }
    };

    const getAllTickets = async () => {
        try {
            const { data } = await axiosInstance.get('/admin/tickets');
            if (data?.data) {
                tickets.value = data.data;
            } else {
                console.error("Данные заявок не найдены в ответе API.");
            }
        } catch (error) {
            console.error("Ошибка при получении заявок:", error);
        }
    };

    const getData = async (entityCode) => {
        try {
            const { data: responseData } = await axiosInstance.get(`/admin/${entityCode}`);

            switch (entityCode) {
                case 'statuses':
                    statuses.value = responseData.data;
                    break;
                case 'roles':
                    roles.value = responseData.data;
                    break;
                case 'categories':
                    categories.value = responseData.data;
                    break;
                case 'users':
                    users.value = responseData.data;
                    break;
                case 'tickets':
                    tickets.value = responseData.data;
                    break;
                default:
                    console.error("Неизвестная сущность:", entityCode);
            }
        } catch (error) {
            console.error(`Ошибка при получении данных для ${entityCode}:`, error);
        }
    };



    return {
        adminEntities,
        statuses,
        categories,
        roles,
        users,
        tickets,
        getAllStatuses,
        getAllCategories,
        getAllRoles,
        getAllUsers,
        getAllTickets,
        getData
    };
});
