import axios from 'axios';

export const baseAPICreator = (baseURL) =>
  axios.create({
    withCredentials: true,
    baseURL,
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
  });
