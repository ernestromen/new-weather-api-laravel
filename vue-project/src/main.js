import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { faHeart } from "@fortawesome/free-regular-svg-icons";
import { createStore } from 'vuex'

library.add(fas, faHeart);

const store = createStore({
    state() {
      return {
        weatherIcon: '',
        mainWeatherDisplay: '',
        forcasts: [],
        chosenCountry: '',
        chosenCity: '',
        countryFlag: '',
        showFavoriteButton: false,
        showFavoriteButtonCondition: true,
        errorMessageDisplay: false,
        errorMessageText: ''
      }
    },
    mutations: {
      updateMainWeatherDisplay(state, newValue) {
        state.mainWeatherDisplay = newValue;
      },
      updateWeatherIcon(state, newValue) {
        state.weatherIcon = newValue;
      },
      updateForcasts(state, newValue) {
        state.forcasts = newValue;
      },
      updateChosenCountry(state, newValue) {
        state.chosenCountry = newValue;
      },
      updateChosenCity(state, newValue) {
        state.chosenCity = newValue;
      },
      updateCountryFlag(state, newValue) {
        state.countryFlag = newValue;
      },
      updateshowFavoriteButton(state, newValue) {
        state.showFavoriteButton = newValue;
      },
      updateshowFavoriteButtonCondition(state, newValue) {
        state.showFavoriteButtonCondition = newValue;
      },
      updateShowFailedApiMessage(state,error) {
        state.errorMessageDisplay = true;
        state.errorMessageText = `${error["message"]} : ${error["name"]} `;
      },
    }
  })

const app = createApp(App)
app.use(store);
app.component("font-awesome-icon", FontAwesomeIcon).mount('#app')
