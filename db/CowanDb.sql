

CREATE TABLE public.client
(
    client_id integer NOT NULL DEFAULT nextval('clients_client_id_seq'::regclass),
    "client_firstName" text COLLATE pg_catalog."default" NOT NULL,
    "client_lastName" text COLLATE pg_catalog."default" NOT NULL,
    client_email text COLLATE pg_catalog."default",
    client_phone text COLLATE pg_catalog."default",
    CONSTRAINT "PK_client_id" PRIMARY KEY (client_id)
);

ALTER TABLE public.client
    OWNER to otxjnchnedusyp;

CREATE TABLE public.item
(
    item_id integer NOT NULL DEFAULT nextval('inventory_inv_id_seq'::regclass),
    item_type text COLLATE pg_catalog."default" NOT NULL,
    item_desc text COLLATE pg_catalog."default" NOT NULL,
    item_price integer NOT NULL,
    item_name text COLLATE pg_catalog."default" NOT NULL,
    "orderItem_id" integer,
    CONSTRAINT "PK_item_id" PRIMARY KEY (item_id),
    CONSTRAINT "FK_orderItem_orderItem_id" FOREIGN KEY ("orderItem_id")
        REFERENCES public."orderItem" ("orderItem_id") MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
        NOT VALID
)

TABLESPACE pg_default;

ALTER TABLE public.item\
    OWNER to otxjnchnedusyp;\
\
\
\
\
CREATE TABLE public."order"\
(\
    order_id integer NOT NULL DEFAULT nextval('orders_order_id_seq'::regclass),\
    order_date date NOT NULL,\
    order_type text COLLATE pg_catalog."default",\
    "orderItem_id" integer,\
    CONSTRAINT "PK_order_id" PRIMARY KEY (order_id),\
    CONSTRAINT "FK_orderItem_orderItem_id" FOREIGN KEY ("orderItem_id")\
        REFERENCES public."orderItem" ("orderItem_id") MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE public."order"\
    OWNER to otxjnchnedusyp;\
\
\
\
\
CREATE TABLE public."orderItem"\
(\
    "orderItem_id" integer NOT NULL DEFAULT nextval('orders_items_order_item_id_seq'::regclass),\
    client_id integer,\
    CONSTRAINT "PK_orderItem_id" PRIMARY KEY ("orderItem_id"),\
    CONSTRAINT "FK_client_client_id" FOREIGN KEY (client_id)\
        REFERENCES public.client (client_id) MATCH SIMPLE\
        ON UPDATE NO ACTION\
        ON DELETE NO ACTION\
        NOT VALID\
)\
\
TABLESPACE pg_default;\
\
ALTER TABLE public."orderItem"\
    OWNER to otxjnchnedusyp;}