select u.name, u.image from users u where id
    IN(select user_id from likes where image="1613781670avatar-3.jpg");
    