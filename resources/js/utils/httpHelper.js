import axios from 'axios';
import { MIX_APP_FRONT_URL } from './config';

const endpoint = MIX_APP_FRONT_URL;

// Show filter is required - only get 1 filter left: sort & filter & star & category & author

// Home Page
// get top 12 book sale
export function getSaleLimit() {
    return axios.get(`${endpoint}/api/books/filter?show=12&sort=sale`);
}

// get top 8 book recommend
export function getRecommendLimit() {
    return axios.get(`${endpoint}/api/books/filter?show=8&sort=recommend`);
}

// get top 8 book popular
export function getPopularLimit() {
    return axios.get(endpoint + '/api/books/filter?show=8&sort=popular');
}

// Product Page
export function getBookFilter(query) {
    return axios.get(endpoint + '/api/books/filter?' + query);
}

export function getSidebarFilter() {
    return axios.get(endpoint + '/api/filters');
}

export function getDetailBookById(id) {
    return axios.get(endpoint + '/api/books/' + id);
}

export function postDataOrder(body) {
    return axios.post(endpoint + '/api/orders', body);
}

// Detail Page

export function getReviewFilterByBook(id, query) {
    return axios.get(endpoint + '/api/books/' + id + '/reviews/filter?' + query);
}

export function getCountReviewByBook(id) {
    return axios.get(endpoint + '/api/books/' + id + '/reviews/filter?show=1&group=count');
}

export function postDataReview(id, body) {
    return axios.post(endpoint + '/api/books/' + id + '/reviews', body);
}
