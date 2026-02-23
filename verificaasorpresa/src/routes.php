<?php

require_once __DIR__ . '/db.php';

function registerRoutes($app) 
{
    //query  1
    $app->get('/pezzi/con-fornitori', function($req, $res) {
        global $connessione;

        $sql = "SELECT DISTINCT p.pnome 
                FROM Pezzi p 
                JOIN Catalogo c ON p.pid = c.pid";

        $result = $connessione->query($sql);
        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');

        //query2 
        $app->get('/fornitori/tutti-pezzi', function($req, $res) {
        global $connessione;
        $sql = "SELECT f.fnome FROM Fornitori f
                WHERE NOT EXISTS (
                    SELECT pid FROM Pezzi p
                    WHERE NOT EXISTS (
                        SELECT * FROM Catalogo c WHERE c.pid=p.pid AND c.fid=f.fid
                    )
                )";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
        });
    });

    //query3
     $app->get('/fornitori/pezzi-rossi', function($req, $res) {
        global $connessione;
        $sql = "SELECT f.fnome FROM Fornitori f
                WHERE NOT EXISTS (
                    SELECT pid FROM Pezzi p WHERE colore='rosso'
                    AND NOT EXISTS (SELECT * FROM Catalogo c WHERE c.pid=p.pid AND c.fid=f.fid)
                )";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });

    //query4
        $app->get('/pezzi/solo-acme', function($req, $res) {
        global $connessione;
        $sql = "SELECT p.pnome FROM Pezzi p
                JOIN Catalogo c ON p.pid=c.pid
                JOIN Fornitori f ON c.fid=f.fid
                WHERE f.fnome='Acme'
                AND NOT EXISTS (
                    SELECT * FROM Catalogo c2
                    JOIN Fornitori f2 ON c2.fid=f2.fid
                    WHERE c2.pid=p.pid AND f2.fnome<>'Acme'
                )";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });

    //query5
    $app->get('/fornitori/sopra-media', function($req, $res) {
        global $connessione;
        $sql = "SELECT DISTINCT c1.fid FROM Catalogo c1
                WHERE c1.costo > (SELECT AVG(c2.costo) FROM Catalogo c2 WHERE c2.pid=c1.pid)";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });

} 

?>