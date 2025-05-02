import { defineStore } from 'pinia'
import {ref} from "vue";
import axiosInstance from "@/utils/api.js";

export const useAuthStore = defineStore('authStore', () => {

  const user = ref(null)
  const userEmail = ref(null)
  const waitCode = ref(false)
  const isAuthenticated = ref(false)
  const errors = ref({})
  const isLoading = ref(true)

  const checkAuth = async () => {
    try {
      const { data } = await axiosInstance.get('/auth/me')
      user.value = data
      isAuthenticated.value = true
    } catch (error) {
      isAuthenticated.value = false
      user.value = null
    } finally {
      isLoading.value = false
    }
  }

  const login = async (formData) => {
    errors.value = {}
    userEmail.value = null
    try {
      await axiosInstance.post('/auth/login', {
        email: formData.email,
        password: formData.password
      })

      waitCode.value = true
      userEmail.value = formData.email

      return true
    } catch (error) {
      handleAuthError(error)

      return false
    }
  }

  const verifyCode = async (code) => {
    try {
      const { data } = await axiosInstance.post('/auth/2fa', {
        email: userEmail.value,
        code: code
      })

      user.value = data
      isAuthenticated.value = true

      return true
    } catch (error) {
      handleAuthError(error)

      return false
    }
  }

  const me = async () => {
    if (user.value === null) {
      await fetchUser()
    }
  }

  const fetchUser = async () => {
    try {
      const { data } = await axiosInstance.get('/auth/me');
      user.value = data;
      isAuthenticated.value = true;
    } catch (error) {
      isAuthenticated.value = false;
    }
  }

  const handleAuthError = (error) => {
    if (error.response?.status === 401) resetState()
    errors.value = error.response?.data?.errors || {
      general: [error.response?.data?.message || 'Ошибка авторизации']
    }
  }

  const resetState = () => {
    user.value = null
    userEmail.value = null
    waitCode.value = false
    isAuthenticated.value = false
    errors.value = {}
  }

  checkAuth()

  return {
    user,
    isAuthenticated,
    errors,
    waitCode,
    userEmail,
    isLoading,
    login,
    verifyCode,
    checkAuth
  }
})
