<template>
  <div
    v-if="$store.state.forcasts.length > 0"
    class="mb-5 mt-5 row d-flex justify-content-center"
  >
    <div
      v-for="(forecast, index) in $store.state.forcasts"
      :key="index"
      class="col-2 bg-success border border-light pb-3"
    >
      <img :src="forecast.day.condition.icon" />
      <br />
      Date: {{ forecast.date }}
      <br />
      Degrees: {{ forecast.day.avgtemp_c }}C &deg;
      <br />
      Condition: {{ forecast.day.condition.text }}
      <br />
      Sunrise: {{ forecast.astro.sunrise }}
      <br />
      Moonrise: {{ forecast.astro.moonrise }}
    </div>
  </div>
</template>