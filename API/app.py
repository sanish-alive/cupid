from flask import Flask, jsonify, make_response, request
import mysql.connector
import cosine_similarity

try:
	mydb = mysql.connector.connect(
		host= "localhost",
		user="root",
		password="",
		database="cupid_db"
	)
	print("[+] Database is Connected. Name :: cupid_db")
except mysql.connector.Error as err:
	print("[-]Database Error :: {}".format(err))

app = Flask(__name__)

@app.route('/cosine', methods = ['POST', 'GET'])
def getData():
	try:
		user_gender = request.form['gender']
		already_visited_partner = int(request.form['alreadyVisited'])
		print(already_visited_partner)
		my_cursor = mydb.cursor(dictionary=True)
		query = "SELECT * FROM user_tb WHERE gender = %s AND userid > %s LIMIT 5"
		params = ('Male' if user_gender == 'Female' else 'Female', already_visited_partner)
		my_cursor.execute(query, params)
		my_partner = my_cursor.fetchall()
		person1 = {
			'lastname': request.form['lastname'],
			'age': int(request.form['age']),
			'height': int(request.form['height']),
			'gender': user_gender,
			'bio': request.form['bio']
    	}
		results = [{'status': 'success'}]
		if my_partner:
			for row in my_partner:
				person2 = {
					'lastname': row['lastname'],
					'age': row['age'],
					'height': row['height'],
					'gender': row['gender'],
					'bio': row['bio']
				}
				cosine_result = cosine_similarity.calculateCosineSimilarity(person1, person2)
				if(cosine_result > 0.3):
					results.append(
						{
							'id': row['userid'],
							'firstname': row['firstname'],
							'lastname': row['lastname'],
							'email': row['email'],
							'gender': row['gender'],
							'height': row['height'],
							'age': row['age'],
							'bio': row['bio'],
							'profileImg': row['profileImg'],
							'cosine': cosine_result})
				
			response = make_response(
				jsonify(results),
				200
			)
			return response
		else: 
			return make_response(jsonify({"status": "failed", "message": "no data found."}), 400) 
	except mysql.connector.Error as err:
		return make_response(jsonify({"status": "failed", "message": f"Something went wrong :: {err}."}), 400) 
	finally:
		my_cursor.close()


if __name__ == "__main__":
	app.run(debug=True)