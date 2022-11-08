import {
    ADD_NEW_BANNER,
    ADD_NEW_RECOMMEND,
    ADD_NEW_POPULAR,
    RESET_DATA_FILTER_PAGE
} from "../const/index";

// Home Page
export const actNewBanner = (content) => {
    return {
        type: ADD_NEW_BANNER,
        content,
    };
};

export const actNewRecommend = (content) => {
    return {
        type: ADD_NEW_RECOMMEND,
        content,
    };
};

export const actNewPopular = (content) => {
    return {
        type: ADD_NEW_POPULAR,
        content,
    };
};

//

export const actResetDataFilterPage = () => {
    return {
        type: RESET_DATA_FILTER_PAGE
    }
}

// Product Page
export const actAddNewDataSidebar = (content) => {
    return {
        type: ADD_NEW_DATA_SIDEBAR,
        content,
    }
}

export const actAddNewFilterQueryParam = (content) => {
    return {
        type: ADD_NEW_FILTER_QUERY_PARAM,
        content,
    }
}

export const actAddNewSortQueryParam = (content) => {
    return {
        type: ADD_NEW_SORT_QUERY_PARAM,
        content,
    }
}
