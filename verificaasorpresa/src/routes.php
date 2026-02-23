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

    //query6
    $app->get('/fornitori/max-ricarico', function($req, $res) {
        global $connessione;
        $sql = "SELECT p.pid, f.fnome FROM Catalogo c
                JOIN Fornitori f ON c.fid=f.fid
                JOIN Pezzi p ON c.pid=p.pid
                WHERE c.costo=(SELECT MAX(c2.costo) FROM Catalogo c2 WHERE c2.pid=c.pid)";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });

    //query7
     $app->get('/fornitori/solo-rossi', function($req, $res) {
        global $connessione;
        $sql = "SELECT fid FROM Fornitori f
                WHERE NOT EXISTS (
                    SELECT * FROM Catalogo c
                    JOIN Pezzi p ON c.pid=p.pid
                    WHERE c.fid=f.fid AND p.colore<>'rosso'
                )";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });

    //query8
    $app->get('/fornitori/rosso-verde', function($req, $res) {
        global $connessione;
        $sql = "SELECT DISTINCT c1.fid FROM Catalogo c1
                JOIN Pezzi p1 ON c1.pid=p1.pid
                WHERE p1.colore='rosso'
                AND EXISTS (
                    SELECT * FROM Catalogo c2
                    JOIN Pezzi p2 ON c2.pid=p2.pid
                    WHERE c2.fid=c1.fid AND p2.colore='verde'
                )";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });

    //query9
        $app->get('/fornitori/rosso-o-verde', function($req, $res) {
        global $connessione;
        $sql = "SELECT DISTINCT c.fid FROM Catalogo c
                JOIN Pezzi p ON c.pid=p.pid
                WHERE p.colore IN ('rosso','verde')";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });
    
    //query10
    $app->get('/pezzi/almeno-due', function($req, $res) {
        global $connessione;
        $sql = "SELECT pid FROM Catalogo GROUP BY pid HAVING COUNT(DISTINCT fid) >= 2";
        $result = $connessione->query($sql);
        $data = [];
        while($row = $result->fetch_assoc()) { $data[] = $row; }
        $res->getBody()->write(json_encode($data));
        return $res->withHeader('Content-Type','application/json');
    });


} 

?>