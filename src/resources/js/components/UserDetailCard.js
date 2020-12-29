import React, { useEffect, useState } from 'react';
import { Card } from 'react-bootstrap';

export default function UserDetailCard(props) {
  const [userDetail, setUserDetail] = useState({});
  useEffect(() => {
    axios.get('/tweets-detail/' + props.user.id)
      .then(res => setUserDetail(res.data))
      .catch(error => console.error(error));
  }, []);
  return (
    <Card>
      <Card.Body style={{ borderBottom: "1px solid rgba(0, 0, 0, 0.125)"}}>
        <h3>{ props.user.name }</h3>
        <div> ツイート数: { userDetail.count}</div>
        <div>フォロー: { userDetail.follows || 0}</div>
        <div>フォロワー: { userDetail.followers || 0}</div>
        <div>{props.user.bio}</div>
      </Card.Body>
    </Card>
  );
}