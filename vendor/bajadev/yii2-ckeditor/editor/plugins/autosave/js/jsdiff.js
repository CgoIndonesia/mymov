﻿function escape_jsdiff(c) {
    c = c.replace(/&/g, "\x26amp;");
    c = c.replace(/</g, "\x26lt;");
    c = c.replace(/>/g, "\x26gt;");
    return c = c.replace(/"/g, "\x26quot;")
}
function diffString(c, b) {
    c = c.replace(/\s+$/, "");
    b = b.replace(/\s+$/, "");
    var d = diff("" == c ? [] : c.split(/\s+/), "" == b ? [] : b.split(/\s+/)), e = "", a = c.match(/\s+/g);
    null == a ? a = ["\n"] : a.push("\n");
    var g = b.match(/\s+/g);
    null == g ? g = ["\n"] : g.push("\n");
    if (0 == d.n.length)for (var f = 0; f < d.o.length; f++)e += "\x3cdel\x3e" + escape_jsdiff(d.o[f]) + a[f] + "\x3c/del\x3e"; else {
        if (null == d.n[0].text)for (b = 0; b < d.o.length && null == d.o[b].text; b++)e += "\x3cdel\x3e" + escape_jsdiff(d.o[b]) + a[b] + "\x3c/del\x3e";
        for (f = 0; f < d.n.length; f++)if (null ==
            d.n[f].text)e += "\x3cins\x3e" + escape_jsdiff(d.n[f]) + g[f] + "\x3c/ins\x3e"; else {
            var h = "";
            for (b = d.n[f].row + 1; b < d.o.length && null == d.o[b].text; b++)h += "\x3cdel\x3e" + escape_jsdiff(d.o[b]) + a[b] + "\x3c/del\x3e";
            e += " " + d.n[f].text + g[f] + h
        }
    }
    return e
}
function randomColor() {
    return "rgb(" + 100 * Math.random() + "%, " + 100 * Math.random() + "%, " + 100 * Math.random() + "%)"
}
function diffString2(c, b) {
    c = c.replace(/\s+$/, "");
    b = b.replace(/\s+$/, "");
    var d = diff("" == c ? [] : c.split(/\s+/), "" == b ? [] : b.split(/\s+/)), e = c.match(/\s+/g);
    null == e ? e = ["\n"] : e.push("\n");
    var a = b.match(/\s+/g);
    null == a ? a = ["\n"] : a.push("\n");
    for (var g = "", f = 0; f < d.o.length; f++)randomColor(), g = null != d.o[f].text ? g + (escape_jsdiff(d.o[f].text) + e[f]) : g + ("\x3cdel\x3e" + escape_jsdiff(d.o[f]) + e[f] + "\x3c/del\x3e");
    e = "";
    for (f = 0; f < d.n.length; f++)e = null != d.n[f].text ? e + (escape_jsdiff(d.n[f].text) + a[f]) : e + ("\x3cins\x3e" + escape_jsdiff(d.n[f]) +
    a[f] + "\x3c/ins\x3e");
    return {o: g, n: e}
}
function diff(c, b) {
    for (var d = {}, e = {}, a = 0; a < b.length; a++)null == d[b[a]] && (d[b[a]] = {
        rows: [],
        o: null
    }), d[b[a]].rows.push(a);
    for (a = 0; a < c.length; a++)null == e[c[a]] && (e[c[a]] = {rows: [], n: null}), e[c[a]].rows.push(a);
    for (a in d)1 == d[a].rows.length && "undefined" != typeof e[a] && 1 == e[a].rows.length && (b[d[a].rows[0]] = {
        text: b[d[a].rows[0]],
        row: e[a].rows[0]
    }, c[e[a].rows[0]] = {text: c[e[a].rows[0]], row: d[a].rows[0]});
    for (a = 0; a < b.length - 1; a++)null != b[a].text && null == b[a + 1].text && b[a].row + 1 < c.length && null == c[b[a].row + 1].text &&
    b[a + 1] == c[b[a].row + 1] && (b[a + 1] = {
        text: b[a + 1],
        row: b[a].row + 1
    }, c[b[a].row + 1] = {text: c[b[a].row + 1], row: a + 1});
    for (a = b.length - 1; 0 < a; a--)null != b[a].text && null == b[a - 1].text && 0 < b[a].row && null == c[b[a].row - 1].text && b[a - 1] == c[b[a].row - 1] && (b[a - 1] = {
        text: b[a - 1],
        row: b[a].row - 1
    }, c[b[a].row - 1] = {text: c[b[a].row - 1], row: a - 1});
    return {o: c, n: b}
};