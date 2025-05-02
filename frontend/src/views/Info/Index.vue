<script setup>

import AuthenticatedLayout from "@/layouts/AuthenticatedLayout.vue";
import {useUserStore} from "@/stores/userStore.js";
const userStore = useUserStore()

</script>

<template>
  <AuthenticatedLayout>
    <div class="info">
      <div class="info-text">
        <p class="info-text__title">Основные шаги</p>
        <ol class="info-text__list" v-if="userStore.checkUserIsAdmin()">
          <li>
            <p>Просмотр новых заявок:</p>
            <ul>
              <li>Откройте страницу «Обращения» и поставьте фильтр по статусу.</li>
              <li>Перейдите на заявку.</li>
              <li>Проверьте категорию, текст заявки.</li>
            </ul>
          </li>

          <li>
            <p>Изменение статуса:</p>
            <ul>
              <li>«Принять» — заявка переходит в работу.</li>
              <li>«Отклонить» — заявка отклонена.</li>
            </ul>
          </li>

          <li>
            <p>Контроль выполнения:</p>
            <ul>
              <li>Отслеживайте статусы «В работе», «Отклонено», «Выполнено».</li>
            </ul>
          </li>
        </ol>
        <ol class="info-text__list" v-else>
          <li>
            <p>Создание заявки:</p>
            <ul>
              <li>Откройте страницу «Создать заявку».</li>
              <li>Заполните форму заявки.</li>
            </ul>
          </li>

          <li>
            <p>Отправка заявки:</p>
            <ul>
              <li>Нажмите кнопку «Отправить».</li>
              <li>После успешного создания вы получите уведомление на почту.</li>
            </ul>
          </li>

          <li>
            <p>Отслеживание статуса:</p>
            <ul>
              <li>Перейдите на страницу «Ваши обращения».</li>
              <li>Отслеживайте статусы заявки.</li>
            </ul>
          </li>

          <li>
            <p>Отмена заявки (если некорректно указаны данные):</p>
            <ul>
              <li>Перейдите по заявке.</li>
              <li>Нажмите кнопку «Удалить заявку».</li>
            </ul>
          </li>
        </ol>
      </div>
      <div class="info-image">
        <img src="@/assets/images/infoImage.png" alt="infoImage">
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.info {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 26px;
  font-weight: bold;
  color: var(--primary-color);
}

.info-text__list {
  padding-left: 2rem;
}

.info-text__title {
  margin-bottom: 30px;
}

.info-text__list ul {
  list-style: disc;
  padding-left: 3rem;
  margin-top: 0.5rem;
}

</style>