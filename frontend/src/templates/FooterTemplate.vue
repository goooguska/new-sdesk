<script setup>

import MainLogo from "@/components/Icons/MainLogo.vue";
</script>

<template>
  <footer class="footer">
    <RouterLink to="/">
      <MainLogo/>
    </RouterLink>
    <div class="text">
      <p>При неполадках обращайтесь к администратору</p>
    </div>
    <div class="socials">
      <p class="socials-text">
        Наши социальные сети
      </p>
      <div class="socials-images">
        <a href="https://vk.com/sber" target="_blank">
          <img src="@/assets/icons/vk.svg" alt="vk">
        </a>
        <a href="https://t.me/sberbank" target="_blank">
          <img src="@/assets/icons/telegram.svg" alt="tg">
        </a>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: var(--primary-color);
  margin-top: 50px;
  font-weight: bold;
  font-size: 14px;
}

.socials {
  display: flex;
  align-items: center;
  gap: 25px;
}

.socials-images {
  display: flex;
  gap: 20px;
}

</style>