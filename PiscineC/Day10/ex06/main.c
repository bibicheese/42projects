/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/21 15:17:36 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/22 11:13:08 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "header.h"

int		main(int argc, char **argv)
{
	int		nb1;
	int		nb2;
	char	*op;

	if (argc != 4)
		return (0);
	nb1 = ft_atoi(argv[1]);
	op = argv[2];
	nb2 = ft_atoi(argv[3]);
	if (nb2 == 0 && (op[0] == '/' || op[0] == '%'))
	{
		if (op[0] == '/')
		{
			ft_putstr("Stop : division by zero\n");
			return (0);
		}
		else
		{
			ft_putstr("Stop : modulo by zero\n");
			return (0);
		}
	}
	ft_putnbr(do_op(nb1, nb2, op[0]));
	ft_putchar('\n');
	return (0);
}
