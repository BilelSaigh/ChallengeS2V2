-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_article";
DROP SEQUENCE IF EXISTS esgi_article_id_seq;
CREATE SEQUENCE esgi_article_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_article" (
                                         "id" integer DEFAULT nextval('esgi_article_id_seq') NOT NULL,
                                         "title" character varying(255) NOT NULL,
                                         "author" integer NOT NULL,
                                         "menu" boolean DEFAULT false NOT NULL,
                                         "status" boolean DEFAULT false NOT NULL,
                                         "comment" boolean DEFAULT false NOT NULL,
                                         "slug" character varying NOT NULL,
                                         "category" integer NOT NULL,
                                         "created_at" timestamp NOT NULL,
                                         "img_url" character varying,
                                         CONSTRAINT "esgi_article_id" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_article" ("id", "title", "author", "menu", "status", "comment", "slug", "category", "created_at", "img_url") VALUES
                                                                                                                                   (2,	'Une photo zoomer est elle est un portrait',	4,	'f',	'f',	't',	'une-photo-zoomer-est-elle-est-un-portrait',	1,	'2023-08-11 19:37:09',	'https://picsum.photos/seed/picsum/200/300'),
                                                                                                                                   (9,	'La photo portrait',	4,	'f',	't',	't',	'la-photo-portrait',	1,	'2023-08-11 20:04:31',	'https://picsum.photos/200/300'),
                                                                                                                                   (10,	'Un zoom ou un portrait',	4,	'f',	'f',	't',	'un-zoom-ou-un-portrait',	2,	'2023-08-11 20:31:07',	'https://picsum.photos/200/300'),
                                                                                                                                   (1,	'Comment faire un beau portrait',	4,	'f',	'f',	't',	'comment-faire-un-beau-portrai',	3,	'2023-08-11 19:13:44',	'https://picsum.photos/200/300?grayscale');

DROP TABLE IF EXISTS "esgi_category";
DROP SEQUENCE IF EXISTS esgi_category_id_seq;
CREATE SEQUENCE esgi_category_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_category" (
                                          "id" integer DEFAULT nextval('esgi_category_id_seq') NOT NULL,
                                          "title" character(80) NOT NULL,
                                          "menu" smallint DEFAULT '0' NOT NULL,
                                          "slug" character varying,
                                          CONSTRAINT "esgi_category_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_category" ("id", "title", "menu", "slug") VALUES
                                                                (1,	'portrait                                                                        ',	0,	'all-portrait'),
                                                                (3,	'test                                                                            ',	0,	'all-test                                                                        '),
                                                                (2,	'histoire                                                                        ',	1,	'all-histoire');

DROP TABLE IF EXISTS "esgi_comment";
DROP SEQUENCE IF EXISTS esgi_comment_id_seq;
CREATE SEQUENCE esgi_comment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_comment" (
                                         "id" integer DEFAULT nextval('esgi_comment_id_seq') NOT NULL,
                                         "comment" text NOT NULL,
                                         "created_at" timestamp DEFAULT now() NOT NULL,
                                         "report" integer DEFAULT '0' NOT NULL,
                                         "article_id" integer NOT NULL,
                                         "author" integer NOT NULL,
                                         CONSTRAINT "esgi_comment_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_comment" ("id", "comment", "created_at", "report", "article_id", "author") VALUES
                                                                                                 (6,	'Mais cette article est trop top hahah',	'2023-08-28 08:10:27',	0,	10,	4),
                                                                                                 (7,	'sdq',	'2023-08-28 08:33:35',	0,	10,	4),
                                                                                                 (8,	'Merci des conseils !!',	'2023-08-28 08:33:56',	0,	10,	4),
                                                                                                 (9,	'trop cool',	'2023-08-28 08:34:22',	0,	10,	4),
                                                                                                 (10,	'jaime',	'2023-08-28 08:34:46',	0,	10,	4),
                                                                                                 (11,	'J''aime trop',	'2023-08-28 08:35:26',	0,	10,	4),
                                                                                                 (12,	'top',	'2023-08-28 08:36:01',	0,	10,	4),
                                                                                                 (13,	'oo',	'2023-08-28 08:36:38',	0,	10,	4),
                                                                                                 (14,	'test final',	'2023-08-28 08:38:09',	0,	10,	4);

DROP TABLE IF EXISTS "esgi_page";
DROP SEQUENCE IF EXISTS esgi_page_id_seq;
CREATE SEQUENCE esgi_page_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_page" (
                                      "id" integer DEFAULT nextval('esgi_page_id_seq') NOT NULL,
                                      "title" character varying NOT NULL,
                                      "slug" character varying NOT NULL,
                                      "status" integer DEFAULT '0' NOT NULL,
                                      "content" text NOT NULL,
                                      "updated_at" timestamp DEFAULT now() NOT NULL,
                                      "menu" integer DEFAULT '0' NOT NULL,
                                      "category" integer,
                                      "description" text NOT NULL,
                                      CONSTRAINT "esgi_page_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_page" ("id", "title", "slug", "status", "content", "updated_at", "menu", "category", "description") VALUES
                                                                                                                          (3,	'Contact',	'contact',	0,	'<div class="row">
            <div class="col-sm-12 ui-resizable" data-type="container-content"><form class="form-content form-horizontal" action="post" data-grid="2-10" data-type="component-form"><div class="fb-text form-group field-text-1693227968392"><label for="text-1693227968392" class="fb-text-label control-label col-sm-2">Emain</label><div class="col-sm-10"><input type="text" placeholder="exampe@example.fr" class="form-control" name="text-1693227968392" id="text-1693227968392"></div></div><div class="fb-textarea form-group field-textarea-1693228003509"><label for="textarea-1693228003509" class="fb-textarea-label control-label col-sm-2">Message</label><div class="col-sm-10"><textarea type="textarea" class="form-control" name="textarea-1693228003509" id="textarea-1693228003509"></textarea></div></div><div class="fb-button form-group field-button-1693227970248"><div class="col-sm-10 col-sm-offset-2"><button type="submit" class="btn btn-info" name="button-1693227970248" style="info" id="button-1693227970248">Send</button></div></div></form><div class="form-data" style="display: none !important;" data-type="component-form" data-grid="2-10"></div><div class="form-data" style="display: none !important;" data-grid="2-10" data-type="component-form"></div><form class="form-content" data-type="component-form" data-grid="2-10"><p class="text-muted lead text-center"><br>[No form content]<br><br></p></form><div class="form-data" style="display: none !important;" data-grid="2-10" data-type="component-form"></div><form class="form-content" data-type="component-form" data-grid="2-10"><p class="text-muted lead text-center"><br>[No form content]<br><br></p></form><form class="form-content" data-grid="2-10" data-type="component-form"><p class="text-muted lead text-center"><br>[No form content]<br><br></p></form><div class="form-data" style="display: none !important;" data-type="component-form" data-grid="2-10"></div><div class="form-data" style="display: none !important;" data-grid="2-10" data-type="component-form"></div><form class="form-content" data-type="component-form" data-grid="2-10"><p class="text-muted lead text-center"><br>[No form content]<br><br></p></form><form class="form-content" data-grid="2-10" data-type="component-form"><p class="text-muted lead text-center"><br>[No form content]<br><br></p></form><div class="form-data" style="display: none !important;" data-type="component-form" data-grid="2-10"></div><form class="form-content" data-grid="2-10" data-type="component-form"><p class="text-muted lead text-center"><br>[No form content]<br><br></p></form><div class="form-data" style="display: none !important;" data-type="component-form" data-grid="2-10"></div><div class="form-data" style="display: none !important;" data-grid="2-10" data-type="component-form"></div><form class="form-content" data-type="component-form" data-grid="2-10"><p class="text-muted lead text-center"><br>[No form content]<br><br></p></form></div>
        </div>',	'2023-08-28 13:07:37',	0,	NULL,	'Thanks to this page you can exchange with me'),
                                                                                                                          (2,	'About me',	'about-me',	1,	'<div class="row">
        <div class="col-sm-6 ui-resizable" data-type="container-content"><div data-type="component-photo">
                <div class="photo-panel" style="text-align: center;">
                    <img src="/Views/keditor-master/keditor/snippets/img/sydney_australia_squared.jpg" width="100%" height="" style="display: inline-block; height: 334px; width: 334px;" class="img-responsive img-circle">
                </div>
            </div></div>
        <div class="col-sm-6 ui-resizable" data-type="container-content"><div data-type="component-text">
<h3>Lorem ipsum</h3>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi molestias eius quaerat, adipisci ratione aliquid eum explicabo illum temporibus? Optio facilis eveniet quam, impedit eos architecto sequi dolorum illo facere, consequatur sit voluptatibus sunt eius ad officia corrupti modi quia minima voluptas vero. Minus, maxime! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi molestias eius quaerat, adipisci ratione aliquid eum explicabo.</p>
</div>
</div>
    </div>',	'2023-08-28 10:49:26',	1,	NULL,	'about me');

DROP TABLE IF EXISTS "esgi_pageviews";
DROP SEQUENCE IF EXISTS esgi_pageviews_id_seq;
CREATE SEQUENCE esgi_pageviews_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_pageviews" (
                                           "id" integer DEFAULT nextval('esgi_pageviews_id_seq') NOT NULL,
                                           "slug" character varying NOT NULL,
                                           "date_inserted" timestamp DEFAULT now() NOT NULL,
                                           CONSTRAINT "esgi_pageviews_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_pageviews" ("id", "slug", "date_inserted") VALUES
                                                                 (1,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-09-01 21:20:24'),
                                                                 (2,	'comment-faire-un-beau-portrai',	'2023-09-01 21:20:36'),
                                                                 (3,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-09-01 21:20:42');

DROP TABLE IF EXISTS "esgi_setting";
CREATE TABLE "public"."esgi_setting" (
                                         "id" integer NOT NULL,
                                         "website_name" character varying NOT NULL,
                                         "h1_color" character varying DEFAULT '#black' NOT NULL,
                                         "polices" character varying DEFAULT 'system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue","Noto Sans","Liberation Sans",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";' NOT NULL,
                                         "p_color" character varying DEFAULT '#black' NOT NULL,
                                         "p_size" character varying DEFAULT '12px' NOT NULL,
                                         "btn_color" character varying DEFAULT '#black' NOT NULL,
                                         CONSTRAINT "esgi_setting_id" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_setting" ("id", "website_name", "h1_color", "polices", "p_color", "p_size", "btn_color") VALUES
    (1,	'Adebc',	'#a2d025',	'Arial, sans-serif',	'#000000',	'12px',	'#df1111');

DROP TABLE IF EXISTS "esgi_user";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_user" (
                                      "id" integer DEFAULT nextval('esgi_user_id_seq') NOT NULL,
                                      "firstname" character(64) NOT NULL,
                                      "lastname" character(120) NOT NULL,
                                      "email" character varying(320) NOT NULL,
                                      "pwd" character varying(128) NOT NULL,
                                      "role" smallint NOT NULL,
                                      "token" character(10) NOT NULL,
                                      "date_inserted" timestamp DEFAULT now(),
                                      "status" boolean DEFAULT false NOT NULL,
                                      CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

COMMENT ON COLUMN "public"."esgi_user"."role" IS '[0=>admin,1=>editor,2=>modo,3=>user]';

INSERT INTO "esgi_user" ("id", "firstname", "lastname", "email", "pwd", "role", "token", "date_inserted", "status") VALUES
                                                                                                                        (1,	'Estelle                                                         ',	'Nkumba                                                                                                                  ',	'nkumba.estelle@gmail.com',	'$2y$10$n2ZGl3NubqQaMI8vALOQ5esKiFNZD8l3EZeD.IZJ6r87HVWcUxnaW',	0,	'5c766dcbb6',	'2023-08-01 08:51:53.774247',	't'),
                                                                                                                        (2,	'Nkumba                                                          ',	'Nkumba                                                                                                                  ',	'estelle27201@gmail.com',	'$2y$10$XLOSs.T/mdPYXDEmNe8ECuC4VttMTjdsBcB1w5loI.Idmfmg6amVu',	4,	'b729      ',	'2023-09-04 08:49:00',	'f'),
                                                                                                                        (5,	'Nkumba                                                          ',	'Nkumba                                                                                                                  ',	'estelle2721@gmail.com',	'$2y$10$py5g/dCFE6c0yi2PfW.3eOoHkdbVpY4DTGS8ieM7kIKQWpcNRR8DW',	4,	'ded9      ',	'2023-09-04 09:01:00',	'f'),
                                                                                                                        (8,	'Nkumba                                                          ',	'Nkumba                                                                                                                  ',	'estelle272001@gmail.com',	'$2y$10$basCFngRFtTkB2shUo56/OfQLtV70LCbComQ2tQyYucSX7ybg55aO',	4,	'da47      ',	'2023-09-04 09:12:05',	'f'),
                                                                                                                        (4,	'Kilyan                                                          ',	'KIKI                                                                                                                    ',	'halimikilyan@gmail.com',	'$2y$10$100Mktvn2qS1EuymuUrV4eOtmFFb7Y7kRD1XCO07BzIG7ztlrQHO6',	0,	'6b7b807028',	'2023-08-03 08:16:31',	'f');

DROP TABLE IF EXISTS "esgi_version";
DROP SEQUENCE IF EXISTS esgi_memento_id_seq;
CREATE SEQUENCE esgi_memento_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_version" (
                                         "id" integer DEFAULT nextval('esgi_memento_id_seq') NOT NULL,
                                         "created_at" timestamp DEFAULT now() NOT NULL,
                                         "content" json NOT NULL,
                                         "user_id" integer NOT NULL,
                                         "article_id" integer NOT NULL,
                                         CONSTRAINT "esgi_memento_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_version" ("id", "created_at", "content", "user_id", "article_id") VALUES
                                                                                        (5,	'2023-08-11 20:31:07',	'{"time":1691785867220,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}}],"version":"2.27.2"}',	4,	10),
                                                                                        (6,	'2023-08-13 18:51:48',	'{}',	4,	1),
                                                                                        (7,	'2023-08-13 18:56:34',	'{}',	4,	1),
                                                                                        (8,	'2023-08-13 18:58:22',	'{}',	4,	1),
                                                                                        (9,	'2023-08-13 18:59:21',	'{}',	4,	1),
                                                                                        (10,	'2023-08-13 20:32:52',	'{"time":1691958772662,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}}],"version":"2.27.2"}',	4,	1),
                                                                                        (11,	'2023-08-13 21:04:01',	'{"time":1691960640972,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":";,dxcn"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (12,	'2023-08-13 21:04:01',	'{"time":1691960641764,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":";,dxcn"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (13,	'2023-08-13 21:04:04',	'{"time":1691960644689,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":";,dxcn"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (14,	'2023-08-13 21:04:07',	'{"time":1691960647613,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (15,	'2023-08-13 22:01:24',	'{"time":1691964084894,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting.."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (16,	'2023-08-13 22:01:26',	'{"time":1691964086781,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (17,	'2023-08-13 22:01:31',	'{"time":1691964091062,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp; est"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (18,	'2023-08-13 22:02:14',	'{"time":1691964134178,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp; est&nbsp;"}},{"id":"Ekj9SBqqcl","type":"paragraph","data":{"text":",n blmk"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (19,	'2023-08-13 22:02:22',	'{"time":1691964142873,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (20,	'2023-08-13 22:02:23',	'{"time":1691964143302,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je t"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (21,	'2023-08-13 22:02:25',	'{"time":1691964145495,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (22,	'2023-08-13 22:02:27',	'{"time":1691964146985,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais test Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (23,	'2023-08-13 22:02:38',	'{"time":1691964158905,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (24,	'2023-08-13 22:03:45',	'{"time":1691964225308,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (25,	'2023-08-13 22:03:55',	'{"time":1691964235134,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento, lmjc"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (26,	'2023-08-13 22:04:03',	'{"time":1691964243063,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (27,	'2023-08-13 22:04:13',	'{"time":1691964253233,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento, ,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (28,	'2023-08-13 22:04:20',	'{"time":1691964260152,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (29,	'2023-08-13 22:05:28',	'{"time":1691964328042,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (30,	'2023-08-13 22:05:35',	'{"time":1691964335555,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (31,	'2023-08-13 22:06:28',	'{"time":1691964387973,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (32,	'2023-08-13 22:06:46',	'{"time":1691964406668,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (33,	'2023-08-13 22:06:54',	'{"time":1691964414450,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (34,	'2023-08-13 22:07:17',	'{"time":1691964437005,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (35,	'2023-08-13 22:07:23',	'{"time":1691964443329,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (36,	'2023-08-13 22:08:24',	'{"time":1691964504831,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (37,	'2023-08-13 22:10:02',	'{"time":1691964602885,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (38,	'2023-08-13 22:11:51',	'{"time":1691964711518,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (39,	'2023-08-13 22:12:56',	'{"time":1691964776358,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (40,	'2023-08-13 22:13:43',	'{"time":1691964823515,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (41,	'2023-08-13 22:15:13',	'{"time":1691964913549,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (42,	'2023-08-15 20:48:10',	'{"time":1692132490622,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}},{"id":"YtIOaLLEEF","type":"image","data":{"url":"https://i.topito.com/ZyCyTNCnfnjCiTDk96awVEMZVAmloeTA6mGxJRLZgyw=/1340x703/smart/filters:fill(white):format(webp):quality(70)/https%3A%2F%2Fmedia.topito.com%2Fwp-content%2Fuploads%2F2020%2F01%2FUNE_TOPITO_homer-meuble-TV.jpg","caption":"","withBorder":false,"withBackground":false,"stretched":false}}],"version":"2.27.2"}',	4,	10),
                                                                                        (43,	'2023-08-15 22:14:01',	'{"time":1692137641252,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"C"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (44,	'2023-08-15 22:15:46',	'{"time":1692137746350,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"CT"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (45,	'2023-08-15 22:15:57',	'{"time":1692137757096,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"T"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (46,	'2023-08-15 22:16:00',	'{"time":1692137760796,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"TEs"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (47,	'2023-08-15 22:17:02',	'{"time":1692137822728,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (48,	'2023-08-15 22:17:37',	'{"time":1692137857231,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregis"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (49,	'2023-08-15 22:20:31',	'{"time":1692138031154,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistreem"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (50,	'2023-08-15 22:21:14',	'{"time":1692138074373,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (51,	'2023-08-17 13:16:20',	'{"time":1692278180909,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"U3pjHD9dWU","type":"paragraph","data":{"text":"Por"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (52,	'2023-08-17 13:17:00',	'{"time":1692278220222,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"U3pjHD9dWU","type":"paragraph","data":{"text":"Porc"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (53,	'2023-08-17 13:17:31',	'{"time":1692278251440,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"U3pjHD9dWU","type":"paragraph","data":{"text":"Porcml"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (54,	'2023-08-17 13:17:40',	'{"time":1692278260841,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"U3pjHD9dWU","type":"paragraph","data":{"text":"Porcmlvb"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (55,	'2023-08-17 13:18:04',	'{"time":1692278284125,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}}],"version":"2.27.2"}',	4,	1),
                                                                                        (56,	'2023-08-17 13:18:41',	'{"time":1692278321138,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"Wxr55GIwVG","type":"paragraph","data":{"text":"Cocuou"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (57,	'2023-08-17 13:19:13',	'{"time":1692278353602,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"Wxr55GIwVG","type":"paragraph","data":{"text":"C"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (58,	'2023-08-17 13:19:40',	'{"time":1692278380745,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}}],"version":"2.27.2"}',	4,	1),
                                                                                        (59,	'2023-08-17 13:21:12',	'{"time":1692278472461,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"lpedaEeefQ","type":"paragraph","data":{"text":"Testbf&nbsp;"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (60,	'2023-08-17 13:21:44',	'{"time":1692278504369,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"lpedaEeefQ","type":"paragraph","data":{"text":"T"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (61,	'2023-08-17 13:22:30',	'{"time":1692278550039,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}}],"version":"2.27.2"}',	4,	1),
                                                                                        (62,	'2023-08-17 13:23:08',	'{"time":1692278588063,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"zRd0vpYZqP","type":"paragraph","data":{"text":"T"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (63,	'2023-08-17 13:23:34',	'{"time":1692278614018,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"zRd0vpYZqP","type":"paragraph","data":{"text":"Test"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (64,	'2023-08-17 13:23:57',	'{"time":1692278637096,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"zRd0vpYZqP","type":"paragraph","data":{"text":"Test Memenyo"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (65,	'2023-08-17 13:24:36',	'{"time":1692278676095,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"zRd0vpYZqP","type":"paragraph","data":{"text":"Test Memento"}}],"version":"2.27.2"}',	4,	1),
                                                                                        (66,	'2023-08-17 13:25:02',	'{"time":1692278702030,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une&nbsp;","level":2}}],"version":"2.27.2"}',	4,	2),
                                                                                        (67,	'2023-08-17 13:25:05',	'{"time":1692278705385,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une pho","level":2}}],"version":"2.27.2"}',	4,	2),
                                                                                        (68,	'2023-08-17 13:25:11',	'{"time":1692278711597,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photi","level":2}}],"version":"2.27.2"}',	4,	2),
                                                                                        (69,	'2023-08-17 13:25:15',	'{"time":1692278715372,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo","level":2}}],"version":"2.27.2"}',	4,	2),
                                                                                        (70,	'2023-08-17 13:25:22',	'{"time":1692278722670,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photolkf","level":2}}],"version":"2.27.2"}',	4,	2),
                                                                                        (71,	'2023-08-17 13:25:27',	'{"time":1692278727461,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photolkfldjkfksdhmbdsjfks djsflsjb kdf:s","level":2}}],"version":"2.27.2"}',	4,	2),
                                                                                        (72,	'2023-08-17 13:25:55',	'{"time":1692278755269,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photolkfldjkfksdhmbdsjfks djsflsjb kdf:s","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (73,	'2023-08-17 13:27:22',	'{"time":1692278842276,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (74,	'2023-08-17 13:29:01',	'{"time":1692278941795,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo r","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (75,	'2023-08-17 13:29:02',	'{"time":1692278942264,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo rp","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (76,	'2023-08-17 13:31:52',	'{"time":1692279112341,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}},{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo&nbsp;","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (77,	'2023-08-17 13:32:13',	'{"time":1692279133413,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer eset&nbsp;","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (78,	'2023-08-17 13:39:54',	'{"time":1692279594519,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est e","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (79,	'2023-08-17 13:40:10',	'{"time":1692279610664,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (80,	'2023-08-17 13:41:32',	'{"time":1692279692763,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle esu","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (81,	'2023-08-17 13:45:12',	'{"time":1692279912022,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle&nbsp;","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (82,	'2023-08-17 13:45:19',	'{"time":1692279919118,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle LMRE","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfh"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (83,	'2023-08-17 13:45:42',	'{"time":1692279942513,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle LMRE","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhd"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (84,	'2023-08-17 13:45:48',	'{"time":1692279948530,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle LMRE","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhdù"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (85,	'2023-08-17 13:46:21',	'{"time":1692279981434,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle un portrait","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhdù"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (86,	'2023-08-17 13:47:14',	'{"time":1692280034552,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle un portraitdf","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhdù"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (87,	'2023-08-17 13:47:29',	'{"time":1692280049223,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle un portrait","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhdù"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (88,	'2023-08-17 13:47:31',	'{"time":1692280051373,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle un portraitiy","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhdù"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (89,	'2023-08-17 13:48:07',	'{"time":1692280087649,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle un portraitiy","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhdùtrry"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (90,	'2023-08-17 13:48:30',	'{"time":1692280110362,"blocks":[{"id":"ILhsK1bzVb","type":"header","data":{"text":"Une photo zoomer est elle un portrait","level":2}},{"id":"q40AuwHs-c","type":"paragraph","data":{"text":"ldksfhdùtrry"}}],"version":"2.27.2"}',	4,	2);

ALTER TABLE ONLY "public"."esgi_article" ADD CONSTRAINT "esgi_article_author_fkey" FOREIGN KEY (author) REFERENCES esgi_user(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_article" ADD CONSTRAINT "esgi_article_category_fkey" FOREIGN KEY (category) REFERENCES esgi_category(id) ON DELETE SET NULL NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_article_id_fkey" FOREIGN KEY (article_id) REFERENCES esgi_article(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_user(id) NOT DEFERRABLE;

-- 2023-09-14 08:02:37.342091+00