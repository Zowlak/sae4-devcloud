from http.client import HTTPException
import os
from fastapi import FastAPI
from pydantic import BaseModel
import sqlite3 
import psycopg2

app = FastAPI()

class Produit(BaseModel):
    nomp: str
    tome: int
    prix: int 
    imagep: str 

def get_db_connection():
    conn = psycopg2.connect(database="lebonmanga", user='dockerpg', password='lannion', host='172.20.0.3', port= '5432')
    return conn 

@app.get("/produits")
async def get_produits():
    try:
        with get_db_connection() as conn:
            cur = conn.cursor()
            cur.execute("SELECT * FROM produits")
            data = cur.fetchall()
        if not data:
            raise HTTPException(status_code=404, detail="Erreur")
    except psycopg2.Error as error:
        print("Erreur psycopg2", error)
    return data 

@app.put("/produits/modifier")
async def put_produits(produit: Produit):
    try:
        with get_db_connection() as conn: 
            cur = conn.cursor()
            cur.execute("UPDATE produits SET nomp = %s, tome = %s, prix = %s, imagep = %s WHERE nomp = %s",
                        (produit.nomp, produit.tome, produit.prix, produit.imagep, produit.nomp))
            conn.commit()
        if not produit:
            raise HTTPException(status_code=404, detail="Erreur")
    except psycopg2.Error as error:
        print("Erreur psycopg2", error)
    finally:
      if conn:
          conn.close()
          print("Connexion fermée")
    return produit

@app.post("/produits/creer")
async def post_produits(produit: Produit):
    try:
        with get_db_connection() as conn:
            cur = conn.cursor()
            cur.execute("INSERT INTO produits(nomp, tome, prix, imagep) VALUES(%s, %s, %s, %s)",
                    (produit.nomp, produit.tome, produit.prix, produit.imagep))
            conn.commit()
        if not produit:
            raise HTTPException(status_code=404, detail="Erreur")
    except psycopg2.Error as error:
        print("Erreur psycopg2", error)
    finally:
        if conn:
            conn.close()
            print("Connexion fermée")
    return produit

@app.delete("/produits/supprimer")
async def delete_produits(produit: Produit):
    try:
        with get_db_connection() as conn:
            cur = conn.cursor()
            cur.execute("DELETE FROM produits WHERE nomp = %s AND tome = %s AND prix = %s AND imagep = %s",
                    (produit.nomp, produit.tome, produit.prix, produit.imagep))
            conn.commit()
        if not produit:
            raise HTTPException(status_code=404, detail="Erreur")
    except psycopg2.Error as error:
        print("Erreur psycopg2", error)
    finally:
        if conn:
            conn.close()
            print("Connexion fermée")
    return "OK"