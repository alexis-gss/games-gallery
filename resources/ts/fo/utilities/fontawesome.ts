import { config, dom, library } from "@fortawesome/fontawesome-svg-core";
import { faGithub } from "@fortawesome/free-brands-svg-icons";
import {
    faArrowLeft,
    faArrowUp,
    faBars,
    faChevronLeft,
    faChevronRight,
    faCircleCheck,
    faCircleExclamation,
    faGlobe,
    faRankingStar,
    faThumbsUp,
    faTriangleExclamation,
    faXmark,
} from "@fortawesome/free-solid-svg-icons";
import {
    faThumbsUp as farThumbsUp,
    faEye as farEye,
    faClock as farClock,
} from "@fortawesome/free-regular-svg-icons";

config.autoReplaceSvg = false;

// @ts-ignore
library.add(
    faArrowUp,
    faXmark,
    faBars,
    faArrowLeft,
    faGithub,
    faRankingStar,
    faGlobe,
    faThumbsUp,
    farThumbsUp,
    faCircleCheck,
    faCircleExclamation,
    faTriangleExclamation,
    faChevronLeft,
    faChevronRight,
    farEye,
    farClock,
);
dom.watch();
