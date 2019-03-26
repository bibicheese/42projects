/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_check.c                                         :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/23 18:59:57 by jmondino          #+#    #+#             */
/*   Updated: 2019/01/31 15:05:27 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		ft_check(char *line, int count)
{
	if (count >= 130)
		ft_error(2);
	if (count % 5 == 0)
	{
		if (line[0] != '\0')
			ft_error(2);
		return (0);
	}
	ft_checkline(line);
	ft_stockline(line);
	return (1);
}

void	ft_checkline(char *line)
{
	int		i;

	i = 0;
	while (line[i])
	{
		if (line[i] != '.' && line[i] != '#')
			ft_error(2);
		i++;
		if (i > 4)
			break ;
	}
	if (i != 4)
		ft_error(2);
}

void	ft_stockline(char *line)
{
	static char		*stock;
	static int		nbl;
	char			*tmp;

	nbl++;
	tmp = ft_strjoin(stock, line);
	ft_memdel((void **)&stock);
	stock = tmp;
	if (nbl == 4)
	{
		nbl = 0;
		ft_nbpieces(stock);
		ft_checkform(stock);
		ft_memdel((void **)&stock);
	}
}

void	ft_nbpieces(char *stock)
{
	int		i;
	int		j;

	i = 0;
	j = 0;
	while (stock[i])
	{
		if (stock[i] == '#')
			j++;
		i++;
	}
	if (j != 4)
		ft_error(2);
}
