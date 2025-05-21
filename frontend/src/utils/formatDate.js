export function formatDate(dateString) {
    if (!dateString) return ''

    const [day, month, year, hours, minutes] = dateString
        .match(/\d+/g)
        .map(Number);

    const date = new Date(year, month - 1, day, hours, minutes);

    return date.toLocaleString('ru-RU', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    })
}
