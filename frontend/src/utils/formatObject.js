export default function formatObject(val) {
    if (!val || typeof val !== 'object') return String(val ?? '');

    const keys = ['login', 'name', 'code', 'title'];
    for (const key of keys) {
        if (val[key]) return val[key];
    }

    return Object.entries(val)
        .map(([k, v]) => `${k}: ${v}`)
        .join(', ');
}

export function formatSimpleObject(val) {
    if (val && typeof val === 'object') {
        val = val.name || val.title || val.login || val.code || JSON.stringify(val);
    }

    return val;
}

export function formatSimpleString(val) {
    if (typeof val === 'string' && val.length > 40) {
        return val.slice(0, 20) + '...';
    }

    return val;
}