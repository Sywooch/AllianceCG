#!/usr/bin/env python
# coding: utf8
# -*- coding: utf-8 -*-

import feedparser

rsscounttext = "Кол-во записей в ленте: "
rssurltext = "URL ленты: "

rss_url = "http://www.opennet.ru/opennews/opennews_all_noadv.rss"

feed = feedparser.parse(rss_url)

print(feed["channel"]["title"])
print(rssurltext, feed["url"])
print(rsscounttext, len(feed['entries']))

for post in feed.entries:
    print(post.title + ": " + post.link + "\r\n")
