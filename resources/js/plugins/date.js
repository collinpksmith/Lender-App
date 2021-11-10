import dayjs from 'dayjs';

export const formatDate = (date) => dayjs(date).format('YYYY-MM-DD HH:mm:ss');
