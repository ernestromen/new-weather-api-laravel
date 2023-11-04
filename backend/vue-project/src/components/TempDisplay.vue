<template>
  <div class="row">
    <div class="col-12 text-center" style="font-size: 50px">
      {{ $store.state.mainWeatherDisplay }}
    </div>
    <div class="col-12 justify-content-center d-flex">
      <img :src="$store.state.weatherIcon" />
    </div>
  </div>
</template>
<script>
export default {
  name: "TempDisplay",
};
</script>