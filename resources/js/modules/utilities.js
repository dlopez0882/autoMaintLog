import { slice } from "lodash";

export const uppercaseFirstLetterAndRemoveUnderscores = function(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).replaceAll('_', ' ')
}

export const removeUnderscores = function(string) {
    return string.replaceAll('_', ' ');
}

export const makeSingular = function(string) {
    return string.slice(0,-1);
}