<template>
  <div v-if="$store.state.showFavoriteButton" class="text-center">
    <h1 v-if="$store.state.showFavoriteButtonCondition">
      <font-awesome-icon @click="toggleHeart" :icon="['far', 'heart']" />
    </h1>
    <h1 v-else><font-awesome-icon @click="toggleHeart" icon="heart" /></h1>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "FavoriteButton",

  methods: {
    toggleHeart() {
      let URL = "http://localhost/newweather/backend/public/addfavorite";

      this.$store.commit(
        "updateshowFavoriteButtonCondition",
        !this.$store.state.showFavoriteButtonCondition
      );

      if (!this.$store.state.showFavoriteButtonCondition) {
        axios
          .post(
            URL,
            {
              data: {
                country: this.$store.state.chosenCountry,
                city: this.$store.state.chosenCity,
                flag: this.$store.state.countryFlag,
              },
            },
            {
              headers: {
                "Content-Type": "application/json",
              },
            }
          )
          .then((response) => {
            console.log(response, "response is here");
          })
          .catch((error) => {
            this.$store.commit("showFailedApiMessage", error);
          });
      } else {
        axios
          .delete(
            `http://localhost/newweather/backend/public/deletefavorite/${this.$store.state.chosenCity}`,
            { headers: { "content-type": "application/json" } }
          )
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            this.$store.commit("showFailedApiMessage", error);
          });
      }
    },
  },
};
</script>