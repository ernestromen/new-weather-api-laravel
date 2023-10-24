<template>
  <div>
    <img v-if="showImage" class="w-50 d-flex m-auto" :src="flagImgUrl" />
    <select v-model="chosenCountry" @change="searchByCountry" class="form-control">
      <option disabled selected value="">Choose Country</option>
      <option
        ref="selectedOption"
        v-for="(country, key) in countiresList"
        :key="key"
        :value="{ key, country }"
        style="color: black"
      >
        {{ key }}
      </option>
    </select>

    <select
      v-if="showCitiesSearch"
      v-model="chosenCity"
      class="form-control mt-5"
      @change="getWeather"
    >
      <option disabled selected value="">Choose city</option>
      <option v-for="(city, key) in cities" :key="key" :value="city" style="color: black">
        {{ city }}
      </option>
    </select>
  </div>
</template>
<script>
import axios from "axios";
import countiresList from "../assets/countriesList2.json";
import countriesAreaCodes from "../assets/countiresCodes.json";

export default {
  name: "SearchBar",
  data() {
    return {
      chosenCountry: "",
      chosenCity: "",
      cities: "",
      APIKEY: "28c91a221f5443818c311156230509",
      countiresList,
      showCitiesSearch: false,
      countriesAreaCodes,
      showImage: false,
      chooseFlag: "",
      favoritesArray: [],
    };
  },
  methods: {
    getAllFavorites() {
      axios
        .get("http://localhost/new-weather-api-laravel/public/getAllFavorites")
        .then((response) => {
          this.favoritesArray = response["data"];
        })
        .catch((error) => {
          this.$store.commit("showFailedApiMessage", error);
        });
    },
    searchByCountry() {
      const mappedData = this.favoritesArray.map((favorite) => {
        return {
          id: favorite.id,
          flag: favorite.flag,
          favorite: favorite.favorite,
          favoriteCity: favorite.favoriteCity,
          createdAt: favorite.CreatedAt,
        };
      });

      for (const e of mappedData) {
        let con = e.favorite === this.chosenCountry["key"];
        if (
          e.favorite === this.chosenCountry["key"] &&
          e.favorite === this.chosenCountry["key"] &&
          e.favoriteCity === this.chosenCity
        ) {
          this.$store.commit("updateshowFavoriteButtonCondition", false);
          break;
        } else {
          this.$store.commit("updateshowFavoriteButtonCondition", true);
        }
      }

      this.cities = this.chosenCountry["country"];
      this.showImage = true;
      this.showCitiesSearch = true;
      this.$store.commit("updateChosenCountry", this.chosenCountry["key"]);
      this.$store.commit("updateshowFavoriteButton", true);

      this.countriesAreaCodes.map((e) => {
        if (e.name == this.chosenCountry["key"]) {
          this.chooseFlag = e.code;
          this.$store.commit("updateCountryFlag", this.chooseFlag);
        }
      });
    },
    getWeather() {
      const mappedData = this.favoritesArray.map((favorite) => {
        return {
          id: favorite.id,
          flag: favorite.flag,
          favorite: favorite.favorite,
          favoriteCity: favorite.favoriteCity,
          createdAt: favorite.CreatedAt,
        };
      });

      for (const e of mappedData) {
        if (e.favoriteCity === this.chosenCity) {
          this.$store.commit("updateshowFavoriteButtonCondition", false);
          break;
        } else {
          this.$store.commit("updateshowFavoriteButtonCondition", true);
        }
      }

      this.$store.commit("updateChosenCity", this.chosenCity);

      let URL = `http://api.weatherapi.com/v1/forecast.json?key=${this.APIKEY}&q=${this.chosenCity}&aqi=no&days=5&aqi=yes&alerts=yes`;

      axios
        .get(URL)
        .then((response) => {
          this.$store.commit(
            "updateMainWeatherDisplay",
            response.data.current.temp_c + "C"
          );
          this.$store.commit("updateWeatherIcon", response.data.current.condition.icon);
          this.$store.commit("updateForcasts", response.data.forecast.forecastday);
        })
        .catch((error) => {
          this.$store.commit("showFailedApiMessage", error);
        });
    },
  },
  mounted() {
    this.getAllFavorites();
  },
  computed: {
    flagImgUrl() {
      return `https://flagsapi.com/${this.chooseFlag}/flat/64.png`;
    },
  },
};
</script>