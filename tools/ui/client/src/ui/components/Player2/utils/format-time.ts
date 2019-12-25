export function formatTime(current) {
  let h = Math.floor(current / 3600);
  let m: string | number = Math.floor((current - h * 3600) / 60);
  let s: string | number = Math.floor(current % 60);

  if (s < 10) {
    s = "0" + s;
  }

  if (h > 0) {
    m = m < 10 ? `0${m}` : m;
    return h + ":" + m + ":" + s;
  } else {
    return m + ":" + s;
  }
}