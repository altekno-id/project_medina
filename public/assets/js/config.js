/**
 * Config
 * -------------------------------------------------------------------------------------
 * ! IMPORTANT: Make sure you clear the browser local storage In order to see the config changes in the template.
 * ! To clear local storage: (https://www.leadshook.com/help/how-to-clear-local-storage-in-google-chrome-browser/).
 */

'use strict';
window.assetsPath = document.documentElement.getAttribute('data-assets-path') || '/assets/';
if (!window.assetsPath.endsWith('/')) {
  window.assetsPath += '/';
}
/* JS global variables
 !Please use the hex color code (#000) here. Don't use rgba(), hsl(), etc
*/
// window.assetsPath = document.documentElement.getAttribute('data-assets-path');
window.templateName = document.documentElement.getAttribute('data-template');
