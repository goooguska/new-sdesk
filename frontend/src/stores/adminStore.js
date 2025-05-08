import { defineStore } from "pinia";
import { ref } from "vue";
import axiosInstance from "@/utils/api.js";

export const useAdminStore = defineStore('adminStore', () => {
    const adminEntities = [
        { name: "Статусы", code: "statuses", refData: ref([]) },
        { name: "Роли", code: "roles", refData: ref([]) },
        { name: "Категории", code: "categories", refData: ref([]) },
        { name: "Пользователи", code: "users", refData: ref([]) },
        { name: "Заявки", code: "tickets", refData: ref([]) },
    ];

    const adminFieldMap = {
        id: 'ID',
        name: 'Имя',
        surname: 'Фамилия',
        email: 'Email',
        login: 'Логин',
        password: 'Пароль',
        created_at: 'Дата создания',
        updated_at: 'Дата обновления',
        role: 'Роль',
        status: 'Статус',
        category: 'Категория',
        title: 'Заголовок',
        description: 'Описание',
        assigned: 'Назначен',
        creator: 'Создатель',
    };

    const excludedFields = ['id', 'created_at', 'updated_at'];

    const relations = {
        role: "roles",
        status: "statuses",
        category: "categories",
        assigned: "users",
        creator: "users",
    };

    const fieldTypes = {
        description: 'textarea',
    };

    const fieldsForCreate = {
        roles: ['name', 'code'],
        statuses: ['name'],
        categories: ['name'],
        users: ['name', 'surname', 'email', 'login', 'password', 'role_id'],
        tickets: ['title', 'description', 'assigned_id', 'creator_id', 'status_id', 'category_id'],
    };

    const getData = async (entityCode) => {
        const entity = adminEntities.find((e) => e.code === entityCode);

        if (!entity) {
            console.error("Неизвестная сущность:", entityCode);
            return;
        }

        try {
            const { data: responseData } = await axiosInstance.get(`/admin/${entityCode}`);
            entity.refData.value = responseData.data;
        } catch (error) {
            console.error(`Ошибка при получении данных для ${entityCode}:`, error);
        }
    };

    return {
        adminEntities,
        adminFieldMap,
        excludedFields,
        relations,
        fieldTypes,
        fieldsForCreate,
        getData,
        ...Object.fromEntries(adminEntities.map(e => [e.code, e.refData])),
    };
});
