<template>
  <div>
    <div v-if="$store.state.showFavoriteButton" class="text-center">
      <h1 v-if="$store.state.showFavoriteButtonCondition">
        <font-awesome-icon @click="toggleHeart" :icon="['far', 'heart']" />
      </h1>
      <h1 v-else><font-awesome-icon @click="toggleHeart" icon="heart" /></h1>
    </div>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  name: 'FavoriteButton',

  methods: {
    toggleHeart() {
      let URL = 'http://localhost/new-weather-api-laravel/public/add-favorite'

      this.$store.commit(
        'updateshowFavoriteButtonCondition',
        !this.$store.state.showFavoriteButtonCondition
      )

      if (!this.$store.state.showFavoriteButtonCondition) {
        axios
          .post(
            URL,
            {
              data: {
                favorite: this.$store.state.chosenCountry,
                favorite_city: this.$store.state.chosenCity,
                country_flag: this.$store.state.countryFlag,
                created_at: new Date().toISOString().slice(0, 19).replace('T', ' ')
              }
            },
            {
              headers: {
                'Content-Type': 'application/json'
              }
            }
          )
          .then((response) => {
            
            this.$store.commit('updateShowFailedApiMessage', error);

            alert('Added to favorites!')
          })
          .catch((error) => {
           this.$store.commit('updateShowFailedApiMessage', error);
          })
      } else {
        axios
          .delete(
            `http://localhost/new-weather-api-laravel/public/delete-favorite/${this.$store.state.chosenCity}`
          )
          .then((response) => {
            alert('Removed from favorites')
          })
          .catch((error) => {
           this.$store.commit('updateShowFailedApiMessage', error);
          })
      }
    }
  }
}
</script>