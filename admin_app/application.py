from flask import Flask, render_template, request
from PIL import Image, ImageOps
from bs4 import BeautifulSoup
import mysql.connector
import subprocess
from datetime import datetime
import os

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def upload_file():
    if request.method == 'POST':
        file = request.files['file']
        name = request.form['name']
        region = request.form['region']
        district = request.form['district']
        descr = request.form['descr']
        mradi = request.form['mradi']
        stprice = request.form['stprice']
        phone = request.form['phone']
        latitude = request.form['latitude']
        longitude = request.form['longitude']
        acc_num = request.form['acc_num']
        pymnt_season = request.form['pymnt_season']	
        status = "free"
        pricepersqm = request.form['pricepersqm']
        now = datetime.now()
        formatted_date = now.strftime('%Y-%m-%d %H:%M:%S')
        
        file.save(file.filename)
        img = Image.open(file.filename)
        img = img.convert("RGB")
        inverted_img = ImageOps.invert(img)
        
    
        inverted_img.save("inverted_image.bmp")
        subprocess.call(["potrace", "-s", "inverted_image.bmp", "-o", "inverted_image.svg"])
        

        with open("inverted_image.svg", "r") as f:
            soup = BeautifulSoup(f, "html.parser")

        cnx = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            database="viwanja"
        )

        cursor = cnx.cursor(buffered=True)
        cursor.execute("INSERT INTO `lands` (name, pricepersqm, created_at, region, district, descr, mradi, stprice, phone, lat, `long`, pymnt_season, acc_num  ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", (str(name), str(pricepersqm), str(formatted_date),  str(region), str(district), str(descr), str(mradi), str(stprice), str(phone), str(latitude), str(longitude), str(pymnt_season), str(acc_num)))
        cnx.commit()

  
        query = "SELECT COUNT(*) FROM portions"
        cursor.execute(query)
        count = cursor.fetchone()[0]

        i = int(count) + 1
        for path in soup.find_all("path"):
            path["class"] = "path-class"
            path["id"] = f'{i}'
            i += 1

            cursor.execute("INSERT INTO `portions` (vector, land_id, status) VALUES (%s, %s, %s)", (str(path), str(name), str(status)))
            cnx.commit()
        
       
        os.remove("inverted_image.bmp")
        os.remove("inverted_image.svg")
        os.remove(file.filename)

        
        return 'File uploaded successfully!'
    else:
        return render_template('upload.html')

if __name__ == '__main__':
    app.run(debug=True)
