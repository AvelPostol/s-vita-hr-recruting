const images = require.context('/src/assets/images', false, /\.(png|jpg|jpeg|gif|svg)$/);
const imagePaths = images.keys().map(images);
export default imagePaths;