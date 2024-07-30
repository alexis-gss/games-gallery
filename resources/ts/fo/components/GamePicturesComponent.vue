<template>
  <div class="position-relative">
    <template v-if="gamePictures.length > 0">
      <template
        v-for="paginateIndex in incrementNumber"
        :key="paginateIndex"
      >
        <template
          v-for="(templateValue, templateIndex) in picturesTemplate"
          :key="templateIndex"
        >
          <div class="row w-100 mx-auto">
            <div
              v-for="(pictureValue, pictureIndex) in templateValue"
              :key="pictureValue"
              class="glightbox-wrapper position-relative col-12 p-0"
              :class="[`col-lg-${gameItems / templateValue}`, (templateValue % 2 === 0) ? `col-sm-6` : `col-sm-12`]"
              data-aos="fade-up"
            >
              <div
                class="p-1"
                v-if="gamePictures[getPictureNumber(paginateIndex, templateIndex) + pictureIndex]"
              >
                <div class="shadow rounded-3">
                  <a
                    :href="getPicturePath(getPictureNumber(paginateIndex, templateIndex) + pictureIndex)"
                    class="glightbox"
                    data-gallery="games-pictures"
                  >
                    <div class="ratio ratio-16x9 overflow-hidden rounded-3">
                      <img
                        :src="getPicturePath(getPictureNumber(paginateIndex, templateIndex) + pictureIndex)"
                        :alt="'Picture n°' + (getPictureNumber(paginateIndex, templateIndex) + pictureIndex + 1) + ' from the game ' + gameName"
                        :title="'Picture n°' + (getPictureNumber(paginateIndex, templateIndex) + pictureIndex + 1) + ' from the game ' + gameName"
                        class="d-none w-100 z-1"
                        @load="gameImageLazyLoad"
                      >
                      <div class="picture-loader position-absolute top-0 start-0 w-100 h-100">
                        <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-primary">
                          <div
                            class="spinner-border text-light"
                            role="status"
                          >
                            <span class="visually-hidden">
                              {{ trans.methods.__("fo_text_loading") }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  <button
                    :class="['picture-ratings btn btn-white position-absolute bottom-0 end-0 m-1 z-2', {disabled: ratingLoading}]"
                    :disabled="ratingLoading"
                    @click="ajaxPictureRating(gamePictures[getPictureNumber(paginateIndex, templateIndex) + pictureIndex].id, getPictureNumber(paginateIndex, templateIndex) + pictureIndex)"
                    :aria-label="trans.methods.__('Cliquez pour ajouter un like ou l\'enlever')"
                    type="button"
                  >
                    <span
                      :id="`ratings-${gamePictures[getPictureNumber(paginateIndex, templateIndex) + pictureIndex].id}`"
                      :data-picture-id="getPictureNumber(paginateIndex, templateIndex) + pictureIndex"
                      class="me-1"
                    >
                      {{ (gamePictures[getPictureNumber(paginateIndex, templateIndex) + pictureIndex].ratings_count) }}
                    </span>
                    <FontAwesomeIcon
                      icon="fa-regular fa-thumbs-up"
                      :class="[{'d-none': picturesRatings.includes(gamePictures[getPictureNumber(paginateIndex, templateIndex) + pictureIndex].id)}]"
                    />
                    <FontAwesomeIcon
                      icon="fa-solid fa-thumbs-up"
                      :class="[{'d-none': !picturesRatings.includes(gamePictures[getPictureNumber(paginateIndex, templateIndex) + pictureIndex].id)}]"
                    />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </template>
      </template>
      <template v-if="!gameLoading && gameAllLoaded">
        <div class="fst-italic text-secondary text-center my-5 w-100">
          {{ trans.methods.__("fo_images_loaded") }}
        </div>
        <div
          v-if="relatedGamesViews.length"
          class="row w-100 mx-auto pb-5"
        >
          <div class="col-12">
            <h2 class="title-font-regular position-relative mx-auto mb-3 w-fit px-5 py-1 text-center">
              {{ trans.methods.__('fo_slide_title') }}
            </h2>
          </div>
          <div :class="['col-12 position-relative px-1 px-md-5', {'games-related-hidden': !swiperInitialized}]">
            <button
              class="swiper-button swiper-games-related-button-prev btn btn-primary position-absolute rounded-circle border-0 z-2"
              :title="trans.methods.__('fo_slide_target', {'target': trans.methods.__('fo_prev')})"
              :aria-label="trans.methods.__('fo_slide_target_aria', {'target': trans.methods.__('fo_prev')})"
              type="button"
            >
              <i class="fa-solid fa-chevron-left" />
            </button>
            <div
              id="swiper-games-related"
              class="swiper swiper-games-related overflow-hidden px-3 pt-1 pb-4"
            >
              <div class="swiper-wrapper align-items-stretch w-fit">
                <div
                  v-for="(relatedGameView, relatedGameViewIndex) in relatedGamesViews"
                  :key="relatedGameViewIndex"
                  v-html="relatedGameView"
                  class="swiper-slide"
                />
              </div>
            </div>
            <button
              class="swiper-button swiper-games-related-button-next btn btn-primary position-absolute rounded-circle border-0 z-2"
              :title="trans.methods.__('fo_slide_target', {'target': trans.methods.__('fo_next')})"
              :aria-label="trans.methods.__('fo_slide_target_aria', {'target': trans.methods.__('fo_next')})"
              type="button"
            >
              <i class="fa-solid fa-chevron-right" />
            </button>
            <div
              v-if="relatedGamesViews.length > 1"
              class="swiper-pagination swiper-games-related-pagination d-flex justify-content-center align-items-center w-100"
            />
          </div>
          <div :class="['d-flex justify-content-center align-items-center w-100 h-100', {'d-none': swiperInitialized}]">
            <div
              class="spinner-border text-primary"
              role="status"
            >
              <span class="visually-hidden">
                {{ trans.methods.__("fo_text_loading") }}
              </span>
            </div>
          </div>
        </div>
      </template>
    </template>
    <div
      v-if="gameLoading"
      class="text-center my-5 w-100"
    >
      <div
        class="spinner-border text-primary"
        role="status"
      >
        <span class="visually-hidden">{{ trans.methods.__("fo_text_loading") }}</span>
      </div>
    </div>
    <div
      v-if="!gameLoading && gamePictures.length <= 0"
      class="text-center my-5 w-100"
    >
      {{ trans.methods.__("fo_images_no_one") }}
    </div>
  </div>
</template>

<script lang="ts" setup>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { Toast } from "bootstrap";
import GLightbox from "glightbox";
import { computed, defineOptions, onMounted, ref, useAttrs } from "vue";
import errors from "./../../modules/errors";
import route from "./../../modules/route";
import trans from "./../../modules/trans";
import Swiper from "swiper";
import { Keyboard, Navigation, Pagination } from "swiper/modules";

defineOptions({
  name: "GamePicturesComponent"
});

// * ATTRIBUTES
const attrs = useAttrs();

// * DATA
const gameName = ref<string>("");
const gameSlug = ref<string>("");
const gamePictures = ref<Array<{
  id: number,
  uuid: string,
  ratings_count: number,
}>>([]);
const gamePage = ref<number>(0);
const gameLastPage = ref<number>(0);
const gameItems = ref<number>(0);
const gameLoading = ref<boolean>(true);
const gameAllLoaded = ref<boolean>(false);
const gameViewer = ref<GLightbox|null>(null);
const picturesTemplate = ref<Array<number>>([4,3,2,3]);
const picturesRatings = ref<Array<number>>([]);
const ratingLoading = ref<boolean>(false);
const swiperInitialized = ref<boolean>(false);
const relatedGamesViews = ref<Array<string>>([]);

// * LIFECYCLE
onMounted((): void => {
  const json = String(attrs.json ?? "{}"),
        data = JSON.parse(json);
  gameName.value = data.gameName;
  gameSlug.value = data.gameSlug;
  gamePage.value = data.gamePictures.current_page;
  gameLastPage.value = data.gamePictures.last_page;
  gameItems.value = data.gamePictures.per_page < 12 ? 12 : data.gamePictures.per_page;
  picturesRatings.value = data.ratingModels;
  relatedGamesViews.value = data.relatedGamesViews;
  checkPicturesLoaded();
  checkScroll();
  getPictures();
});

// * COMPUTED

/**
  * Increment the current page number when the
  * user scroll to the bottom.
  * @return Array<number>
  */
const incrementNumber = computed<Array<number>>(() =>
  gamePictures.value.map((_, index) => index)
    .filter((index) => index % gameItems.value === 0));

// * METHODS

/**
  * Check if all images are loaded on mounted component.
  * @return void
  */
function checkPicturesLoaded(): void {
  if (gamePage.value >= gameLastPage.value) {
    initSwiper();
  }
}

/**
  * Check if all images are loaded,
  * if not, get next pictures.
  * @return void
  */
function checkScroll(): void {
  window.addEventListener("scroll", () => {
    if (
      window.innerHeight + window.scrollY >=
      document.body.offsetHeight - 800 &&
      !gameLoading.value
    ) {
      if (gamePage.value < gameLastPage.value) {
        gamePage.value++;
        gameLoading.value = true;
        getPictures();
      } else {
        if (!swiperInitialized.value) {
          initSwiper();
        }
      }
    }
  });
}

/**
  * Check if all images are loaded on mounted component.
  * @return void
  */
function initSwiper(): void {
  if (!gameAllLoaded.value) {
    setTimeout(() => {
      setSwiper();
      gamesRelatedImageLazyLoad();
    }, 800);
  }
  gameAllLoaded.value = true;
}

/**
  * Load the current page.
  @return void
  */
function getPictures(): void {
  const url = "?page=" + gamePage.value;
  window.axios
    .get(url)
    .then((response) => {
      if (response.data.data !== undefined) {
        gamePictures.value = gamePictures.value.concat(
          Object.values(response.data.data)
        );
      }
      gameLoading.value = false;
      updateGlightbox();
    })
    .catch(errors.methods.ajaxErrorHandler);
}

/**
  * Return the number of the picture.
  * @param paginateIndex Number of the picture.
  * @param templateIndex Number of the template.
  * @return number
  */
function getPictureNumber(paginateIndex: number, templateIndex: number): number {
  let result = 0;
  if (picturesTemplate.value[templateIndex - 1] !== undefined) {
    for (let index = 0; index <= templateIndex - 1; index++) {
      result += picturesTemplate.value[index];
    }
  }
  return paginateIndex + result;
}

/**
  * Verify when an image of a game are loaded.
  * @param e Event
  * @return void
  */
function gameImageLazyLoad(e: Event): void {
  const nodeTarget = e.target as HTMLImageElement;
  displayImage(nodeTarget, ".glightbox-wrapper");
}

/**
  * Verify when images of related games are loaded.
  * @return void
  */
function gamesRelatedImageLazyLoad(): void {
  const nodeTargets = document.querySelectorAll("#swiper-games-related .card .img-fluid") as NodeListOf<HTMLImageElement>;
  nodeTargets.forEach(nodeTarget => {
    if (nodeTarget.complete) {
      displayImage(nodeTarget, ".card-img-top");
      return;
    }
    nodeTarget.addEventListener("load", function () {
      displayImage(nodeTarget, ".card-img-top");
    });
  });
}

/**
  * Display a specific image,
  * Then hide placeholder of the image.
  * @return void
  */
function displayImage(image: HTMLImageElement, parentClass: string): void {
  image.classList.remove("d-none");
  const nodeTargetParent = image.closest(parentClass);
  nodeTargetParent?.querySelector(".picture-loader")?.classList.add("z-0");
  nodeTargetParent?.querySelector(".picture-loader")?.classList.remove("z-3");
  nodeTargetParent?.querySelector(".btn.picture-ratings")?.classList.remove("d-none");
}

/**
  * Return the path of the picture.
  * @param n Number of the picture.
  * @return string
  */
function getPicturePath(n: number): string {
  return `${location.origin}/storage/pictures/${gameSlug.value}/${gamePictures.value[n].uuid}.webp`;
}

/**
  * Update Glightbox elements.
  * @return void
  */
function updateGlightbox(): void {
  setTimeout(() => {
    gameViewer.value?.destroy();
    gameViewer.value = new GLightbox({
      selector: ".glightbox",
    });
  }, 800);
}

/**
  * Get the update rating route.
  * @return string
  */
function getUpdateRatingRoute(): string {
  const updateRatingRoute = route.methods.route("fo.ratings.update");
  if (!updateRatingRoute) {
    throw new Error("Undefined route fo.ratings.update");
  }
  return updateRatingRoute;
}

/**
  * Update picture ratings.
  * @return void
  */
function updatePictureRatings(pictureId: number): void {
  // Picture ratings button
  (picturesRatings.value.includes(pictureId)) ?
    picturesRatings.value.splice(picturesRatings.value.indexOf(pictureId), 1) :
    picturesRatings.value.push(pictureId);
  // Picture ratings count
  const pictureRatingNode = document.getElementById(`ratings-${pictureId}`);
  pictureRatingNode!.textContent = String(
    Number(pictureRatingNode?.textContent) +
      ((picturesRatings.value.includes(pictureId)) ? +1 : -1));
}

/**
  * Create the bootstrap toast from an id.
  * @return void
  */
function createBoostrapToastFromId(toastId: string): void {
  const toast = document.getElementById(toastId) as HTMLDivElement|null;
  if (toast) {
    const bootstrapToast = new Toast(toast);
    bootstrapToast?.show();
    toast.addEventListener("hidden.bs.toast", () => {
      document.getElementById(toastId)?.remove();
    });
  }
}

/**
  * Update a specific picture rating.
  * @param id Picture's id.
  * @return void
  */
function ajaxPictureRating(id: number, place: number): void {
  ratingLoading.value = true;
  window.axios
    .post(getUpdateRatingRoute(), { picture_id: id, picture_place: place })
    .then((reponse) => {
      let toastContainer = document.querySelector(".toast-container") as HTMLDivElement|null;
      if (toastContainer) {
        // Add the view to the toast wrapper.
        toastContainer!.innerHTML += reponse.data.view;
        updatePictureRatings(reponse.data.pictureId);
        createBoostrapToastFromId(reponse.data.toastId);
      } else {
        throw new Error("Toast wrapper is not present");
      }
    })
    .then(() => { ratingLoading.value = false; })
    .catch(errors.methods.ajaxErrorHandler);
}

/**
  * Create the slider for related games.
  * @return void
  */
function setSwiper(): void {
  new Swiper(".swiper-games-related", {
    modules: [Navigation, Keyboard, Pagination],
    grabCursor: true,
    slidesPerView: 1.3,
    initialSlide: 0,
    centeredSlides: true,
    spaceBetween: 10,
    navigation: {
      nextEl: ".swiper-games-related-button-next",
      prevEl: ".swiper-games-related-button-prev",
    },
    keyboard: {
      enabled: true,
    },
    pagination: {
      el: ".swiper-games-related-pagination",
      clickable: true,
      renderBullet: function (index: number, className: string) {
        return `<button class="btn btn-primary rounded-circle border-0 mx-2 p-0 ${className}" title="${trans.methods.__("fo_slide_id",{"slideId": String(index + 1)})}" aria-label="${trans.methods.__("fo_slide_id_aria",{"slideId": String(index + 1)})}" type="button"></button>`;
      },
    },
    breakpoints: {
      576: {
        centeredSlides: true,
        slidesPerView: 1.3,
        spaceBetween: 25,
      },
      768: {
        centeredSlides: true,
        slidesPerView: 2,
        spaceBetween: 35,
      },
      992: {
        centeredSlides: true,
        slidesPerView: 3,
        spaceBetween: 35,
      },
    },
  });
  setTimeout(() => {
    swiperInitialized.value = true;
  }, 200);
}
</script>

<style lang="scss" scopped>
@import "bootstrap/scss/functions";
@import "bootstrap/scss/variables";
@import "bootstrap/scss/mixins";
@import "bootstrap/scss/placeholders";
@import "./../../../sass/fo/utilities/variables";

.glightbox img,
.card img {
  transition: .3s;
}
.glightbox-wrapper:hover img,
.glightbox-wrapper:focus img,
.card:hover img,
.card:focus img {
  transform: scale(1.05) !important;
}
.picture-ratings {
  width: fit-content;
  min-width: 55px;
  height: 40px;
  border-radius: calc(var(--bs-border-radius-lg) - 0.08rem);
  border-top-right-radius: 0;
  border-bottom-left-radius: 0;
}
.swiper {
  &-wrapper {
    height: 100% !important;
  }
  &-button-disabled {
    visibility: hidden;
  }
  &-slide {
    height: auto;
  }
}
.swiper-pagination {
  &-bullet-active {
    background-color: rgb(var(--bs-secondary-rgb)) !important;
  }
  button {
    width: 1rem;
    height: 1rem;
  }
}
.swiper-button{
  height: fit-content !important;
  &:first-of-type,
  &:last-of-type {
    bottom: -0.6rem;
    @include media-breakpoint-up(md) {
      top: 50%;
      transform: translateY(-50%);
    }
  }
  &:first-of-type {
    left: calc(var(--bs-gutter-x) * .1);
  }
  &:last-of-type {
    right: calc(var(--bs-gutter-x) * .1);
  }
}
.games-related-hidden {
  visibility: hidden;
  height: 0;
}
</style>
