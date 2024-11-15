<?php
require_once __DIR__ . '/../models/Produto.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class ProdutoController {
    private $produtoModel;

    public function __construct($db) {
        $this->produtoModel = new Produto($db);
    }

    public function gerarRelatorioPDF() {
        $produtos = $this->produtoModel->listarProdutos();

        // Requisição de visualização (HTML do relatório)
        ob_start();
        include __DIR__ . '/../views/relatorio_produtos.php';
        $html = ob_get_clean();

        // Geração do PDF com MPDF
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output("relatorio_produtos.pdf", \Mpdf\Output\Destination::INLINE);
    }
}
