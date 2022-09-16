import { slice } from "lodash";
import numeral from 'numeral';

export const uppercaseFirstLetterAndRemoveUnderscores = function(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).replaceAll('_', ' ')
}

export const removeUnderscores = function(string) {
    return string.replaceAll('_', ' ');
}

export const makeSingular = function(string) {
    return string.slice(0,-1);
}

export const numberFormatter = function(value, format) {
    if(format == 'currency') {
        return numeral(value).format("$0,0.00");
    } else if(format == 'number') {
        return numeral(value).format("0,0");
    } else {
        return value;
    }
}