// - Tools for CI(s) the "Configurable Information".
// - The CI presents the value wrapper for most of internal types and has
//   various reference and platform implementations like iOS native.
// - The UI packages xide,xblox,xideve and xfile and all their dialogs are generated by this type.
// - The widget class is mapped in CI['type'] which points to xide/types/ECIType, an
//   int enumeration from -1 = Unknown to at least 32 more values, after xide.types.ECIType.END begins
//   the user land

// - Urgent: the reason for value[0] in the code below is back-compate to pre Dojo - 2.0 stores. To be removed soon.

import * as _ from 'lodash';
import { CI, CIList, CIS } from '../interfaces/CI';
import { IObjectLiteral } from '../interfaces/index';
import {isArray} from '../std/primitives';

export function toOptions(cis: CIList): Array<IObjectLiteral> {
	cis = flattenCIS(cis);
	let result = [];
	for (let i = 0; i < cis.length; i++) {
		let ci: CI = cis[i];
		result.push({
			name: toString(ci['name']),
			value: getCIValue(ci),
			type: toInt(ci['type']),
			enumType: toString(ci['enumType']),
			visible: toBoolean(ci['visible']),
			active: toBoolean(ci['active']),
			changed: toBoolean(ci['changed']),
			group: toString(ci['group']),
			user: toObject(ci['user']),
			dst: toString(ci['dst']),
			params: toString(ci['params'])
		});
	}
	return result;
};
export function toObject(data: any): any | null {
	if (data != null) {
		return data[0] ? data[0] : data;
	}
	return null;
};
export function flattenCIS(cis: CIList): CIList {
	return [] as CIList;
};
export function toInt(data: any): number {
	if (_.isNumber(data)) {
		return data;
	}
	let resInt = -1;
	if (data != null) {
		let _dataStr = data.length > 1 ? data : data[0] ? data[0] : data;
		if (_dataStr != null) {
			resInt = parseInt(_dataStr, 10);
		}
	}
	return resInt;
}
export function arrayContains(array: Array<any>, element: any): boolean {
	for (let i = 0; i < array.length; i++) {
		let _e = array[i];
		if (_e === element) {
			return true;
		}
	}
	return false;
}
export function setStoreCIValueByField(data: any, field: string, value: any): CI {
	if (data[field] == null) {
		data[field] = [];
	}
	data[field][0] = getStringValue(value);
	return data;
}
export function createOption(label: string, value: any, extra: any): IObjectLiteral {
	return _.mixin({
		label: label,
		value: value != null ? value : label
	}, extra);
}
export function hasValue(data: any): boolean {
	return data.value && data.value[0] != null && data.value[0].length > 0 && data.value[0] !== '0' && data.value[0] !== "undefined" && data.value[0] !== 'Unset';
}
export function getInputCIByName(data: CIS | CIList, name: string): CI | null {
	if (!data || !name) {
		return null;
	}
	let chain = 0;
	let dstChain = chain === 0 ? (<CIS> data).inputs : chain === 1 ? (<CIS> data).outputs : null;
	if (!dstChain) {// has no chains, be nice
		dstChain = data as CIList;
	}
	if (dstChain != null) {
		for (let i = 0; i < dstChain.length; i++) {
			let ci = dstChain[i];
			let _n = getStringValue(ci.name);
			if (_n != null && _n.toLowerCase() === name.toLowerCase()) {
				return ci;
			}
		}
	}
	return null;
}
export function getInputCIById(data: CIS | CIList, name: string): CI | null {
	if (!data) {
		return null;
	}
	let chain = 0;
	let dstChain = chain === 0 ? (<CIS> data).inputs : chain === 1 ? (<CIS> data).outputs : null;
	// has no chains, be nice
	!dstChain && (dstChain = data as CIList);
	if (dstChain != null) {
		for (let i = 0; i < dstChain.length; i++) {
			let ci: CI = dstChain[i];
			let _n = getStringValue(ci.id);
			if (_n != null && _n.toLowerCase() === name.toLowerCase()) {
				return ci;
			}
		}
	}
	return null;
}
export function getCIByChainAndName(data: CIS | CIList, chain: number, name: string | any): CI | null {
	if (!data) {
		return null;
	}
	let dstChain = chain === 0 ? (<CIS> data).inputs : chain === 1 ? (<CIS> data).outputs : null;
	if (!dstChain) {
		// has no chains
		dstChain = data as CIList;
	}
	if (dstChain != null) {
		for (let i = 0; i < dstChain.length; i++) {
			let ci = dstChain[i];
			let _n = getStringValue(ci.name);
			if (_n != null && _n.toLowerCase() === name.toLowerCase()) {
				return ci;
			}
		}
	}
	return null;
}
export function getCIById(data: CIS | CIList, chain: number, id: string): CI | null {
	let dstChain = chain === 0 ? (<CIS> data).inputs : chain === 1 ? (<CIS> data).outputs : null;
	if (dstChain != null) {
		for (let i = 0; i < dstChain.length; i++) {
			let ci = dstChain[i];
			if (ci.id[0] === id[0]) {
				return ci;
			}
		}
	}
	return null;
}
export function getCIInputValueByName(data: CIS | CIList, name: string | any): string | number | boolean | Object | null {
	let ci = getCIByChainAndName(data, 0, name);
	if (ci) {
		return ci.value;
	}
	return null;
}
export function getCIValue(data: CI): string | number | boolean | Object | null {
	return getCIValueByField(data, 'value');
}
export function getStringValue(d: any): string | null {
	return toString(d);
}
export function toString(d: any | string): string | null {
	if (d != null) {
		if (!isArray(d)) {
			return '' + d;
		}
		if (d && d.length === 1 && d[0] == null) {
			return null;
		}
		return '' + (d[0] != null ? d[0] : d);
	}
	return null;
}
export function setIntegerValue(data: any, value: any): void {
	if (data != null) {
		if (isArray(data)) {
			data[0] = value;
		} else {
			data = value;
		}
	}
}
export function getCIValueByField(data: any, field: string): string | number | boolean | Object | null {
	if (data[field] != null) {
		if (isArray(data[field])) {
			return data[field][0] ? data[field][0] : data[field];
		} else {
			return data[field];
		}
	}
	return null;
}
export function setCIValueByField(data: any, field: string, value: any): CI | null {
	if (!data) {
		return data;
	}
	if (data[field] == null) {
		data[field] = [];
	}
	data[field] = value;
	return data;
}
export function setCIValue(data: CIS | CIList, field: string, value: any): CI | null {
	let ci = getInputCIByName(data, field);
	if (ci) {
		setCIValueByField(ci, 'value', value);
	}
	return ci;
}
export function getCIInputValueByNameAndField(data: any, name: string, field: string): string | number | boolean | Object | null {
	let ci = getCIByChainAndName(data, 0, name);
	if (ci) {
		return ci[field];
	}
	return null;
}
export function getCIInputValueByNameAndFieldStr(data: any, name: any, field: any): string | number | boolean | Object | null {
	const rawValue = getCIInputValueByNameAndField(data, name, field);
	if (rawValue) {
		return getStringValue(rawValue);
	}
	return null;
}
export function toString2(val: any): string | null {
	if (val != null) {
		if (!isArray(val)) {
			return '' + val;
		}
		if (val && val.length === 1 && val[0] == null) {
			return null;
		}
		return '' + (val[0] != null ? val[0] : val);
	}
	return null;
}
export function toBoolean(data: any): boolean {
	let result = false;
	if (data != null) {
		let _dataStr = data[0] ? data[0] : data;
		if (_dataStr != null) {
			result = !!((_dataStr === true || _dataStr === 'true' || _dataStr === '1'));
		}
	}
	return result;
}
export function getCIInputValueByNameAndFieldBool(data: any, name: string, field: string): boolean | null {
	let rawValue = getCIInputValueByNameAndField(data, name, field);
	if (rawValue) {
		return toBoolean(rawValue);
	}
	return null;
}
