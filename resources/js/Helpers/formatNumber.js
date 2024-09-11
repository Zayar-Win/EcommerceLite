export const formatNumber = (value) => {
    let numberValue = Number(value)
    return Number.isInteger(numberValue) ? numberValue.toString() : numberValue.toFixed(2);
}